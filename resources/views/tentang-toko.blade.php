@extends('layouts.app')

@section('title', 'Tentang Toko')

@section('content')

<style>
    .store-card {
        background: #ffffff;
        border: 1px solid #fbcfe8;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
    }
    
    .text-pink-main {
        color: #be185d;
    }

    .bg-pink-soft {
        background-color: #fdf2f8;
    }

    .btn-pink-outline {
        color: #be185d;
        border-color: #fbcfe8;
        background-color: #ffffff;
    }

    .btn-pink-outline:hover {
        background-color: #fdf2f8;
        color: #be185d;
        border-color: #f472b6;
    }
</style>

<div class="container py-4">
    <!-- Kartu Utama Menyatu dengan Tombol Kembali -->
    <div class="store-card p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center">
                <div class="bg-pink-soft p-3 rounded-circle me-3 text-pink-main fw-bold fs-4">
                    🛍️
                </div>
                <div>
                    <h3 class="fw-bold text-pink-main mb-0">Sifa Beauty</h3>
                    <small class="text-muted">Toko Kosmetik & Skincare Terpercaya</small>
                </div>
            </div>

            <!-- Tombol Menyatu di Sini -->
            <a href="{{ route('dashboard') }}" class="btn btn-pink-outline btn-sm fw-bold">
                ← Kembali
            </a>
        </div>

        <p class="text-secondary mb-0" style="line-height: 1.6;">
            Selamat datang di SA Cosmetics! Kami menyediakan berbagai pilihan produk kecantikan, perawatan kulit, dan kosmetik original dengan harga terbaik.
        </p>
    </div>

    <!-- Informasi Detail -->
    <div class="row g-3">
        <div class="col-md-6 col-lg-3">
            <div class="store-card p-3 h-100">
                <small class="text-muted d-block mb-1">Jam Operasional</small>
                <div class="fw-bold text-dark">08:00 - 20:00 WIB</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="store-card p-3 h-100">
                <small class="text-muted d-block mb-1">Kontak WA</small>
                <div class="fw-bold text-dark">0877-6204-1570</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="store-card p-3 h-100">
                <small class="text-muted d-block mb-1">Lokasi</small>
                <div class="fw-bold text-dark">Jl. Raya Toko Kosmetik No. 123</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="store-card p-3 h-100">
                <small class="text-muted d-block mb-1">Status</small>
                <span class="badge bg-success bg-opacity-10 text-success fw-bold px-2 py-1">Buka Setiap Hari</span>
            </div>
        </div>
    </div>
</div>

@endsection