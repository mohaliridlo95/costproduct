@extends('layouts.app')

@section('title', 'Food Cost Calculator')

@section('styles')
 <style>
        body {
            background-color: #f8f9fa;
            padding-bottom: 70px; /* Tambahkan ruang agar konten tidak menutupi navigasi sticky */
        }
        .form-header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            border-radius: 8px 8px 0 0;
        }
        .form-container {
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
        .sticky-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            background-color: #f8f9fa;
            border-top: 1px solid #ddd;
            padding: 10px 0;
        }
        .sticky-nav .nav-item {
            flex: 1;
            text-align: center;
        }
        .sticky-nav .nav-link {
            color: #333;
            font-size: 1.2rem;
        }
        .sticky-nav .nav-link.active {
            color: #0d6efd;
        }
    </style>
 @endsection

@section('content')
<div class="container my-5">
    <div class="form-container">
        <div class="form-header">
            <h2 class="text-center">Food Cost Calculator</h2>
        </div>
        <form class="p-4" method="POST" action="/calculate">
            @csrf
            
            <div class="mb-4">
                <label for="namaproduct" class="form-label"><strong>Nama Produk</strong></label>
                <input type="text" name="namaproduct" id="namaproduct" class="form-control" placeholder="Nama Produk" value="{{ old('namaproduct') }}">
            </div>

            <div class="mb-4">
                <label for="product_quantity" class="form-label"><strong>Jumlah Produk</strong></label>
                <input type="number" name="product_quantity" id="product_quantity" class="form-control" placeholder="Jumlah Produk (wajib)" value="{{ old('product_quantity') }}" required>
            </div>

            <h4>Bahan Baku</h4>
            <div id="materials" class="mb-4">
                <div class="row g-2">
                    <div class="col-md-3">
                        <input type="text" name="materials[0][name]" class="form-control" placeholder="Nama Bahan" value="{{ old('materials.0.name') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="materials[0][kebutuhan]" class="form-control" placeholder="Jumlah Kebutuhan Gram/Ml" value="{{ old('materials.0.kebutuhan') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="materials[0][quantity]" class="form-control" placeholder="Jumlah" value="{{ old('materials.0.quantity') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="materials[0][unit_price]" class="form-control" placeholder="Harga per Unit" value="{{ old('materials.0.unit_price') }}">
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-outline-primary mb-4" onclick="addMaterial()">Tambah Bahan</button>

            <h4>Tenaga Kerja</h4>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <input type="number" name="labor[workers]" class="form-control" placeholder="Jumlah Pekerja" value="{{ old('labor.workers') }}">
                </div>
                <div class="col-md-4">
                    <input type="number" name="labor[rate]" class="form-control" placeholder="Tarif per Jam" value="{{ old('labor.rate') }}">
                </div>
                <div class="col-md-4">
                    <input type="number" name="labor[hours]" class="form-control" placeholder="Total Jam Kerja" value="{{ old('labor.hours') }}">
                </div>
            </div>

            <h4>Overhead dan Operasional</h4>
            <div class="mb-4">
                <input type="number" name="overhead" class="form-control mb-3" placeholder="Biaya Overhead" value="{{ old('overhead') }}">
                <input type="number" name="additional" class="form-control" placeholder="Biaya Operasional Tambahan" value="{{ old('additional') }}">
            </div>

            <h4>Margin Keuntungan</h4>
            <div class="mb-4">
                <input type="number" name="profit_margin" class="form-control" placeholder="Persentase Margin (%)" value="{{ old('profit_margin') }}">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success btn-lg">Hitung HPP</button>
            </div>
        </form>
    </div>
</div>


@endsection

@section('scripts')
<script>
    function addMaterial() {
        const materialsDiv = document.getElementById('materials');
        const index = materialsDiv.children.length;
        const row = `
            <div class="row g-2 mt-2">
                <div class="col-md-3">
                    <input type="text" name="materials[${index}][name]" class="form-control" placeholder="Nama Bahan">
                </div>
                <div class="col-md-3">
                    <input type="text" name="materials[${index}][kebutuhan]" class="form-control" placeholder="Jumlah Kebutuhan Gram/Ml">
                </div>
                <div class="col-md-3">
                    <input type="number" name="materials[${index}][quantity]" class="form-control" placeholder="Jumlah">
                </div>
                <div class="col-md-3">
                    <input type="number" name="materials[${index}][unit_price]" class="form-control" placeholder="Harga per Unit">
                </div>
            </div>`;
        materialsDiv.insertAdjacentHTML('beforeend', row);
    }

    // Tambahkan logika untuk mengaktifkan tombol navigasi
    const currentPath = window.location.pathname;
    if (currentPath === '/') {
        document.getElementById('home-link').classList.add('active');
    } else if (currentPath.includes('calculate')) {
        document.getElementById('calculate-link').classList.add('active');
    } else if (currentPath.includes('history')) {
        document.getElementById('history-link').classList.add('active');
    }
</script>
@endsection



