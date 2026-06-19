<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Product;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function __construct(
        private TransactionService $transactionService,
        private \App\Services\TransactionParserService $parserService
    ) {}

    /**
     * Get the current store ID for the authenticated user.
     */
    private function getStoreId(): int
    {
        $store = auth()->user()->currentStore();
        abort_unless($store, 403, 'Anda belum memiliki usaha.');

        return $store->id;
    }

    /**
     * Display transaction history.
     */
    public function index(Request $request): View
    {
        $storeId = $this->getStoreId();

        $transactions = Transaction::where('store_id', $storeId)
            ->with('user', 'details')
            ->when($request->query('search'), function ($query, $search) {
                $query->where('invoice_number', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('transactions.index', [
            'transactions' => $transactions,
            'search' => $request->query('search'),
        ]);
    }

    /**
     * Show the POS / create transaction page.
     */
    public function create(): View
    {
        $storeId = $this->getStoreId();

        $products = Product::where('store_id', $storeId)
            ->where('stock', '>', 0)
            ->orderBy('name')
            ->get();

        return view('transactions.create', [
            'products' => $products,
        ]);
    }

    /**
     * Parse chat text into transaction preview.
     */
    public function parseChat(Request $request)
    {
        $storeId = $this->getStoreId();
        
        $request->validate([
            'chat_text' => 'required|string'
        ]);

        $result = $this->parserService->parseText($request->input('chat_text'), $storeId);

        if (isset($result['error'])) {
            return redirect()->back()->withInput()->with('error', $result['error']);
        }

        if (!empty($result['errors'])) {
            return redirect()->back()->withInput()->with('error', implode('<br>', $result['errors']));
        }

        // Return to a preview state (which is just the create view with pre-filled items)
        $products = Product::where('store_id', $storeId)->where('stock', '>', 0)->orderBy('name')->get();

        return view('transactions.create', [
            'products' => $products,
            'parsedItems' => $result['items'],
            'parsedTotal' => $result['total_amount'],
            'chatText' => $request->input('chat_text'),
        ]);
    }

    /**
     * Store a new transaction.
     */
    public function store(TransactionRequest $request): RedirectResponse
    {
        $storeId = $this->getStoreId();
        $userId = auth()->id();

        $transaction = $this->transactionService->processTransaction(
            storeId: $storeId,
            userId: $userId,
            items: $request->validated('items'),
            paymentAmount: (float) $request->validated('payment_amount'),
            notes: $request->validated('notes'),
        );

        app(\App\Services\ActivityLogService::class)->log(
            $storeId,
            $userId,
            'checkout',
            "Memproses transaksi baru dengan total Rp" . number_format($transaction->total_amount, 0, ',', '.') . " (Invoice: {$transaction->invoice_number})"
        );

        return redirect()
            ->route('transactions.show', $transaction)
            ->with('success', 'Transaksi berhasil disimpan.');
    }

    /**
     * Show the invoice for a transaction.
     */
    public function show(Transaction $transaction): View
    {
        $storeId = $this->getStoreId();
        abort_unless($transaction->store_id === $storeId, 403, 'Anda tidak memiliki akses ke transaksi ini.');

        $transaction->load('details', 'user', 'store');

        return view('transactions.invoice', [
            'transaction' => $transaction,
        ]);
    }
}
