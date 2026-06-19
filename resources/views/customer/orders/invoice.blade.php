<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $order->invoice_number }}</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; color: #333; line-height: 1.5; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #eee; padding-bottom: 20px; }
        .invoice-title { font-size: 24px; font-weight: bold; margin: 0 0 10px 0; }
        .store-info, .customer-info { margin-bottom: 20px; }
        .info-title { font-weight: bold; margin-bottom: 5px; color: #555; }
        table { w-full; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f9f9f9; }
        .text-right { text-align: right; }
        .total-row td { font-weight: bold; }
        .footer { text-align: center; font-size: 12px; color: #777; margin-top: 50px; border-top: 1px solid #eee; padding-top: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="invoice-title">INVOICE</h1>
        <p><strong># {{ $order->invoice_number }}</strong></p>
        <p>Tanggal: {{ $order->created_at->format('d F Y') }}</p>
        <p>Status: <strong style="text-transform: uppercase;">{{ $order->status }}</strong></p>
    </div>

    <table style="width: 100%; border: none; margin-bottom: 30px;">
        <tr>
            <td style="border: none; vertical-align: top; width: 50%;">
                <div class="store-info">
                    <div class="info-title">Penjual:</div>
                    <p style="margin:0;"><strong>{{ $order->store->name }}</strong></p>
                    <p style="margin:0;">{{ $order->store->address }}</p>
                    <p style="margin:0;">{{ $order->store->contact }}</p>
                </div>
            </td>
            <td style="border: none; vertical-align: top; width: 50%;">
                <div class="customer-info">
                    <div class="info-title">Pembeli / Penerima:</div>
                    @if($order->address)
                        <p style="margin:0;"><strong>{{ $order->address->recipient_name }}</strong> ({{ $order->address->phone }})</p>
                        <p style="margin:0;">{{ $order->address->address }}</p>
                        <p style="margin:0;">{{ $order->address->district }}, {{ $order->address->city }}</p>
                        <p style="margin:0;">{{ $order->address->province }} {{ $order->address->postal_code }}</p>
                    @endif
                </div>
            </td>
        </tr>
    </table>

    <table style="width: 100%;">
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th class="text-right">Harga</th>
                <th class="text-right">Qty</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->product_name }}</td>
                <td class="text-right">{{ 'Rp ' . number_format($item->price, 0, ',', '.') }}</td>
                <td class="text-right">{{ $item->quantity }}</td>
                <td class="text-right">{{ 'Rp ' . number_format($item->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            
            <tr>
                <td colspan="4" class="text-right"><strong>Total Produk</strong></td>
                <td class="text-right">{{ 'Rp ' . number_format($order->items->sum('subtotal'), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="4" class="text-right"><strong>Ongkos Kirim</strong></td>
                <td class="text-right">{{ 'Rp ' . number_format($order->shipping_fee, 0, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <td colspan="4" class="text-right">TOTAL TAGIHAN</td>
                <td class="text-right">{{ 'Rp ' . number_format($order->total_amount, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Terima kasih telah berbelanja di Smart UMKM Bali.</p>
        <p>Invoice ini sah dan diterbitkan oleh sistem secara otomatis.</p>
    </div>
</body>
</html>
