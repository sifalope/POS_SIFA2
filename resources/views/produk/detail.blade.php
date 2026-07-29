@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
<style>
    /* Background Halaman */
    body {
        background-color: #fff1f7;
    }

    /* Container Utama */
    .detail-card-container {
        max-width: 500px;
        margin: 40px auto;
    }

    /* Judul Halaman */
    .page-title {
        color: #be185d;
        font-weight: 700;
        margin-bottom: 20px;
        text-align: center;
    }

    /* Card Soft Pink */
    .product-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 24px;
        border: 1px solid #fbcfe8;
        box-shadow: 0 10px 25px rgba(236, 72, 153, 0.08);
    }

    /* Wrapper Foto Produk */
    .img-wrapper {
        width: 100%;
        height: 220px;
        border-radius: 15px;
        overflow: hidden;
        background-color: #fce7f3;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #fbcfe8;
        margin-bottom: 20px;
    }

    .img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .no-img-text {
        color: #be185d;
        font-weight: 600;
        font-size: 14px;
    }

    /* Informasi Produk */
    .product-title {
        color: #9d174d;
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 16px;
    }

    .info-group {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px dashed #fce7f3;
    }

    .info-label {
        color: #94a3b8;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .info-value {
        color: #334155;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .price-tag {
        color: #db2777;
        font-weight: 700;
    }

    /* Tombol Kembali Soft Pink */
    .btn-pink-back {
        display: inline-block;
        width: 100%;
        text-align: center;
        background-color: #f472b6;
        color: #ffffff !important;
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 12px;
        text-decoration: none;
        margin-top: 20px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(244, 114, 182, 0.3);
    }

    .btn-pink-back:hover {
        background-color: #ec4899;
        transform: translateY(-1px);
    }
</style>

<div class="container">
    <div class="detail-card-container">
        <h3 class="page-title">Detail Produk</h3>

        <div class="product-card">
            <div class="img-wrapper">
                @if(!empty($produk->foto) && Storage::disk('public')->exists($produk->foto))
                    <img src="{{ asset('storage/' . $produk->foto) }}" alt="{{ $produk->nama_produk ?? $produk->nama }}">
                @else
                    <span class="no-img-text">Foto Tidak Tersedia</span>
                @endif
            </div>

            <h4 class="product-title">{{ $produk->nama_produk ?? $produk->nama ?? 'Nama Produk' }}</h4>

            <div class="info-group">
                <span class="info-label">Harga Beli</span>
                <span class="info-value">Rp {{ number_format($produk->harga_beli ?? 0, 0, ',', '.') }}</span>
            </div>

            <div class="info-group">
                <span class="info-label">Harga Jual</span>
                <span class="info-value price-tag">Rp {{ number_format($produk->harga_jual ?? $produk->harga ?? 0, 0, ',', '.') }}</span>
            </div>

            <div class="info-group">
                <span class="info-label">Stok</span>
                <span class="info-value">{{ $produk->stok ?? 0 }} unit</span>
            </div>

            <div class="info-group">
                <span class="info-label">Nama Penginput</span>
                <span class="info-value">{{ $produk->user->name ?? $produk->penginput ?? 'Admin' }}</span>
            </div>

            <a href="{{ route('admin.produk.index') }}" class="btn-pink-back">
                &larr; Kembali
            </a>
        </div>
    </div>
</div>
@endsection