@extends('layouts.app')

@section('title', 'Hasil Food Cost Calculator')

@section('styles')
 <style>
        body {
            background-color: #f8f9fa;
        }
        .result-header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            border-radius: 8px 8px 0 0;
        }
        .result-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
 @endsection

@section('content')
<div class="result-container">
    <div class="result-header">
        <h2 class="text-center">Hasil Perhitungan HPP</h2>
    </div>
   
        <div class="p-4">
            <h4>Nama Produk:</h4>
            <p class="mb-4"><strong>{{ $namaproduct }}</strong></p>

            <h4>Jumlah Produk:</h4>
            <p class="mb-4"><strong>{{ $product_quantity }}</strong> unit</p>

            <h4>Rincian Bahan Baku:</h4>
            <table class="table table-striped table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th>Nama Bahan</th>
                        <th>Kebutuhan (Gram/Ml)</th>
                        <th>Jumlah</th>
                        <th>Harga per Unit</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materials as $material)
                        <tr>
                            <td>{{ $material['name'] }}</td>
                            <td>{{ $material['kebutuhan'] }}</td>
                            <td>{{ $material['quantity'] }}</td>
                            <td>{{ number_format($material['unit_price'], 2) }}</td>
                            <td>{{ number_format($material['quantity'] * $material['unit_price'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p class="mb-4"><strong>Total Biaya Bahan Baku:</strong> {{ number_format($total_materials, 2) }}</p>

            <h4>Biaya Tenaga Kerja:</h4>
            <p><strong>Total Biaya Tenaga Kerja (seluruh batch):</strong> {{ number_format($labor_cost, 2) }}</p>
            <p class="mb-4"><strong>Biaya Tenaga Kerja per Produk:</strong> {{ number_format($labor_cost_per_product, 2) }}</p>

            <h4>Overhead dan Operasional:</h4>
            <p><strong>Overhead per Produk:</strong> {{ number_format($overhead_per_product, 2) }}</p>
            <p class="mb-4"><strong>Operasional Tambahan per Produk:</strong> {{ number_format($additional_per_product, 2) }}</p>

            <h4>Total HPP dan Rekomendasi Harga Jual:</h4>
            <p><strong>Total HPP per Produk:</strong> {{ number_format($total_hpp_per_product, 2) }}</p>
            <p class="mb-4"><strong>Rekomendasi Harga Jual ({{ $profit_margin }}% margin):</strong> {{ number_format($recommended_price, 2) }}</p>

            <form method="POST" action="/download" class="text-center">
                @csrf
                <input type="hidden" name="namaproduct" value="{{ $namaproduct }}">
                <input type="hidden" name="product_quantity" value="{{ $product_quantity }}">
                <input type="hidden" name="materials" value="{{ json_encode($materials) }}">
                <input type="hidden" name="total_materials" value="{{ $total_materials }}">
                <input type="hidden" name="labor_cost" value="{{ $labor_cost }}">
                <input type="hidden" name="labor_cost_per_product" value="{{ $labor_cost_per_product }}">
                <input type="hidden" name="overhead_per_product" value="{{ $overhead_per_product }}">
                <input type="hidden" name="additional_per_product" value="{{ $additional_per_product }}">
                <input type="hidden" name="total_hpp" value="{{ $total_hpp_per_product }}">
                <input type="hidden" name="recommended_price" value="{{ $recommended_price }}">
                <input type="hidden" name="profit_margin" value="{{ $profit_margin }}">
                <button type="submit" class="btn btn-primary btn-lg">Download PDF</button>
            </form>
        </div>
        
</div>
@endsection

