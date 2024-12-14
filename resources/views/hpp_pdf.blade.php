<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HPP Calculation</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        .summary p { margin: 5px 0; }
    </style>
</head>
<body>
    <h1>HPP Calculation</h1>

    <h3>Rincian Bahan Baku: <strong>{{ $namaproduct }}</strong> </h3>
    <h3> Jumlah Sajian : <strong> {{ $product_quantity}} </strong> Unit</h3>
    <table>
        <thead>
            <tr>
                <th>Nama Bahan</th>
                <th>Kebutuhan (Gram/Ml)</th>
                <th>Jumlah</th>
                <th>Harga per Unit</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @if(is_array($materials))
        @foreach($materials as $material)
            <tr>
                <td>{{ $material['name'] }}</td>
                                <td>{{ $material['kebutuhan'] }}</td>
                <td>{{ $material['quantity'] }}</td>
                <td>{{ number_format($material['unit_price'], 2) }}</td>
                <td>{{ number_format($material['quantity'] * $material['unit_price'], 2) }}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="4">Tidak ada data bahan baku.</td>
        </tr>
    @endif
        </tbody>
    </table>

    <div class="summary">
        <h3>Rincian Biaya Lainnya:</h3>
        <p><strong>Total Biaya Bahan Baku:</strong> {{ number_format($total_materials, 2) }}</p>
        <p><strong>Total Biaya Tenaga Kerja:</strong> {{ number_format($labor_cost, 2) }}</p>
        <p><strong>Biaya Tenaga Kerja per Produk:</strong> {{ number_format($labor_cost_per_product, 2) }}</p>
        <p><strong>Overhead per Produk:</strong> {{ number_format($overhead_per_product, 2) }}</p>
        <p><strong>Operasional Tambahan per Produk:</strong> {{ number_format($additional_per_product, 2) }}</p>
    </div>

    <div class="summary">
        <h3>Total HPP dan Rekomendasi Harga Jual:</h3>
        <p><strong>Total HPP per Produk:</strong> {{ number_format($total_hpp_per_product, 2) }}</p>
        <p><strong>Rekomendasi Harga Jual ({{ $profit_margin }}% Margin):</strong> {{ number_format($recommended_price, 2) }}</p>
    </div>
</body>
</html>

