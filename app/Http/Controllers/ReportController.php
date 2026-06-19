<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function __construct(
        private ReportService $reportService
    ) {}

    private function getStoreId(): int
    {
        $store = auth()->user()->currentStore();
        abort_unless($store, 403, 'Anda belum memiliki usaha.');

        return $store->id;
    }

    /**
     * Display the report page.
     */
    public function index(Request $request): View
    {
        $type = $request->query('type', 'daily');
        $date = $request->query('date');

        $storeId = $this->getStoreId();
        $report = $this->reportService->generateReport($storeId, $type, $date);

        return view('reports.index', [
            'report' => $report,
            'currentType' => $type,
            'currentDate' => $date,
            'store' => auth()->user()->currentStore(),
        ]);
    }

    /**
     * Export report as PDF.
     */
    public function exportPdf(Request $request)
    {
        $type = $request->query('type', 'daily');
        $date = $request->query('date');

        $storeId = $this->getStoreId();
        $store = auth()->user()->currentStore();

        \App\Jobs\GenerateReportPdfJob::dispatch($storeId, $type, $date, $store);

        return redirect()->route('reports.index', ['type' => $type, 'date' => $date])
            ->with('success', 'Laporan sedang diproses dan akan segera tersedia. Silakan cek berkala.');
    }
}
