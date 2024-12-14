@extends('layouts.app')

@section('title', 'Riwayat Perhitungan HPP')

@section('content')
<div class="container my-5">
    <h2>Riwayat Perhitungan HPP</h2>

    <ul>
        @forelse($history as $entry)
            <li>
                <strong>{{ $entry['namaproduct'] }}</strong> - 
                {{ $entry['product_quantity'] }} unit - 
                HPP: {{ number_format($entry['total_hpp_per_product'], 2) }} - 
                Harga Jual: {{ number_format($entry['recommended_price'], 2) }} - 
                <small>{{ $entry['date'] }}</small>
            </li>
        @empty
            <li>Tidak ada riwayat perhitungan.</li>
        @endforelse
    </ul>

    <form method="POST" action="/clear-history">
        @csrf
        <button type="submit" class="btn btn-danger mt-3">Hapus Riwayat</button>
    </form>
</div>
@endsection

