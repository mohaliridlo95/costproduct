@extends('layouts.app')

@section('title', 'Home - HPP Cost Product')

@section('content')
<div class="container my-5">
    <div class="text-center">
        <h1 class="mb-4">Selamat Datang di HPP Cost Product</h1>
        <p class="lead">
            HPP Cost Product adalah aplikasi sederhana untuk membantu Anda menghitung Harga Pokok Produksi (HPP) dan memberikan rekomendasi harga jual dengan margin keuntungan yang sesuai.
        </p>
       
    </div>
    <div class="row align-items-center">
    <div class="col-md-6 mb-4">
            <div class="bg-light p-4 rounded shadow-sm">
                <h4 class="text-primary mb-3">Fitur Utama</h4>
            <ul>
                <li>Hitung HPP per produk dengan mudah.</li>
                <li>Rekomendasi harga jual dengan margin keuntungan.</li>
                <li>Riwayat perhitungan HPP untuk referensi.</li>
                <li>Unduh laporan HPP dalam format PDF.</li>
            </ul>
        </div>
        </div>
        
         <div class="col-md-6">
            <div class="bg-light p-4 rounded shadow-sm">
            
                <h4 class="text-primary mb-3">Manfaat Utama</h4>
            <ul>
                <li>Membantu menetapkan harga jual yang kompetitif.</li>
                <li>Meningkatkan efisiensi perhitungan biaya produksi.</li>
                <li>Cocok untuk usaha kecil hingga besar.</li>
                <li>Mudah digunakan oleh siapa saja.</li>
            </ul>
        </div>
    </div>
    
    <div class="text-center mt-5">
        <a href="/" class="btn btn-primary btn-lg">Mulai Hitung HPP</a>
    </div>
    </div>
</div>
@endsection

