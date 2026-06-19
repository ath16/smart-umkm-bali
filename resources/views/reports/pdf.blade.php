<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan - {{ $business->name }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            line-height: 1.5;
            font-size: 12px;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #5D4037;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #5D4037;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0 0;
            color: #666;
        }
        .info-section {
            margin-bottom: 20px;
        }
        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }
        .info-table td {
            vertical-align: top;
        }
        .summary-box {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .summary-box h3 {
            margin-top: 0;
            color: #5D4037;
        }
        .metrics-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .metrics-table th, .metrics-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            width: 25%;
        }
        .metrics-table th {
            background-color: #f5f5f5;
            color: #555;
            text-transform: uppercase;
            font-size: 10px;
        }
        .metrics-table td {
            font-size: 14px;
            font-weight: bold;
        }
        .text-green { color: #16a34a; }
        .text-red { color: #dc2626; }
        
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .data-table th, .data-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .data-table th {
            background-color: #f5f5f5;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
            color: #555;
        }
        .text-right { text-align: right !important; }
        .footer {
            margin-top: 50px;
            text-align: right;
            font-size: 11px;
            color: #777;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>{{ $business->name }}</h1>
        <p>{{ $business->address ?? 'Alamat tidak tersedia' }} | {{ $business->contact ?? 'Kontak tidak tersedia' }}</p>
    </div>

    <table class="info-table">
        <tr>
            <td>
                <h2>Laporan Penjualan</h2>
                <p><strong>Periode:</strong> {{ $report['range']['label'] }}</p>
                <p><strong>Dicetak pada:</strong> {{ now()->translatedFormat('l, d F Y H:i') }}</p>
            </td>
        </tr>
    </table>

    <div class="summary-box">
        <h3>Ringkasan Eksekutif</h3>
        <p>{{ $report['narrative'] }}</p>
    </div>

    <table class="metrics-table">
        <tr>
            <th>Pendapatan Kotor</th>
            <th>Total Modal</th>
            <th>Laba Bersih</th>
            <th>Margin Laba</th>
        </tr>
        <tr>
            <td>Rp{{ number_format($report['totalRevenue'], 0, ',', '.') }}</td>
            <td>Rp{{ number_format($report['totalCost'], 0, ',', '.') }}</td>
            <td class="{{ $report['totalProfit'] >= 0 ? 'text-green' : 'text-red' }}">
                Rp{{ number_format($report['totalProfit'], 0, ',', '.') }}
            </td>
            <td>{{ $report['profitMargin'] }}%</td>
        </tr>
    </table>

    <h3>Rincian Produk Terjual</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th class="text-right">Qty Terjual</th>
                <th class="text-right">Pendapatan</th>
                <th class="text-right">Modal</th>
                <th class="text-right">Laba</th>
            </tr>
        </thead>
        <tbody>
            @forelse($report['productBreakdown'] as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->product_name }}</td>
                <td class="text-right">{{ $item->quantity }}</td>
                <td class="text-right">Rp{{ number_format($item->revenue, 0, ',', '.') }}</td>
                <td class="text-right">Rp{{ number_format($item->cost, 0, ',', '.') }}</td>
                <td class="text-right {{ $item->profit >= 0 ? 'text-green' : 'text-red' }}">
                    Rp{{ number_format($item->profit, 0, ',', '.') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center">Tidak ada data penjualan pada periode ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dokumen ini di-generate secara otomatis oleh sistem Smart UMKM Bali.</p>
    </div>

</body>
</html>
