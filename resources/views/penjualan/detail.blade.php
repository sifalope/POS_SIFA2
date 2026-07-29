@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

<style>
    /* Background & Layout */
    body {
        background-color: #fff1f7;
    }

    /* Judul & Header */
    .page-title {
        color: #be185d;
        font-weight: 700;
        margin-bottom: 20px;
    }

    /* Card Info Kasir & Ringkasan */
    .card-info {
        background: #ffffff;
        border: 1px solid #fbcfe8;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(236, 72, 153, 0.08);
        transition: all 0.3s ease;
    }

    .card-info .card-title {
        color: #be185d;
        font-weight: 700;
    }

    /* Custom Table Style Soft Pink */
    .table-container {
        background: #ffffff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(236, 72, 153, 0.1);
        border: 1px solid #fce7f3;
        margin-top: 20px;
    }

    .table-custom {
        width: 100%;
        margin-bottom: 0;
        border-collapse: collapse;
    }

    .table-custom thead {
        background-color: #fbcfe8;
    }

    .table-custom thead th {
        color: #be185d;
        padding: 15px;
        font-weight: 700;
        border: none;
    }

    .table-custom tbody td, 
    .table-custom tbody th {
        padding: 14px 15px;
        color: #475569;
        vertical-align: middle;
        border-bottom: 1px solid #fce7f3;
    }

    .table-custom tbody tr:hover {
        background-color: #fff0f6;
    }

    /* Styling Gambar Produk */
    .img-product {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #fbcfe8;
    }

    /* Badge Placeholder jika foto kosong */
    .no-img-badge {
        width: 50px;
        height: 50px;
        background-color: #fce7f3;
        color: #be185d;
        font-size: 10px;
        font-weight: bold;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<div class="container py-4">
    <h4 class="page-title">Detail Penjualan</h4>

    <div class="card card-info mb-4" style="max-width: 24rem;">
        <div class="card-body">
            <h5 class="card-title mb-3">Kasir : {{ $sale->user->name ?? 'Kasir' }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">
                Tanggal Transaksi : {{ optional($sale->created_at)->translatedFormat('d-m-Y H:i:s') }}
            </h6>
            <h6 class="card-text fw-bold text-danger mt-2">
                Total Pembayaran : Rp.{{ number_format($sale->total_pembayaran ?? 0, 0, ',', '.') }}
            </h6>
        </div>
    </div>

    <div class="table-container">
        <table class="table table-custom">
            <thead>
                <tr>
                    <th scope="col" class="text-center" style="width: 60px;">No</th>
                    <th scope="col" style="width: 90px;">Foto</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col" class="text-end">Harga</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sale->itempenjualan as $item)
                <tr>
                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                    <td>
                        @if(!empty($item->produk->foto) && Storage::disk('public')->exists($item->produk->foto))
                            <img src="{{ asset('storage/' . $item->produk->foto) }}" alt="Foto Produk" class="img-product">
                        @else
                            <div class="no-img-badge">No Pic</div>
                        @endif
                    </td>
                    <td class="fw-semibold">{{ $item->produk->nama ?? $item->produk->nama_produk }}</td>
                    <td class="text-end fw-bold">Rp.{{ number_format($item->produk->harga_jual ?? $item->harga ?? 0, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">Belum ada item transaksi pada penjualan ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection