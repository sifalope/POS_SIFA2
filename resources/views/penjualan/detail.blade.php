@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

<style>
    body {
        background-color: #fff1f7;
    }

    .page-title {
        color: #be185d;
        font-weight: 700;
        margin-bottom: 20px;
    }

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

    .img-product {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #fbcfe8;
    }

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

    .btn-pink-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: #fbcfe8;
        color: #be185d;
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 10px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid #f472b6;
    }

    .btn-pink-back:hover {
        background-color: #be185d;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(190, 24, 93, 0.25);
        transform: translateY(-2px);
    }

    .btn-pink-print {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: #be185d;
        color: #ffffff;
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 10px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid #be185d;
        cursor: pointer;
    }

    .btn-pink-print:hover {
        background-color: #9d174d;
        box-shadow: 0 4px 12px rgba(190, 24, 93, 0.3);
        transform: translateY(-2px);
    }

    /* FORMAT STRUK KASIR KETIKA DICETAK (PRINT) */
    @media print {
        @page {
            size: 80mm auto;
            margin: 0;
        }

        body {
            background-color: #ffffff !important;
            font-family: 'Courier New', Courier, monospace !important;
            color: #000000 !important;
            margin: 0 !important;
            padding: 10px !important;
            width: 80mm !important;
        }

        /* Sembunyikan elemen web yang tidak perlu */
        .btn-pink-back, 
        .btn-pink-print, 
        .page-title, 
        header, 
        nav, 
        .sidebar, 
        th:nth-child(2), 
        td:nth-child(2) { 
            display: none !important; /* foto disembunyikan saat cetak struk */
        }

        .container {
            width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .card-info {
            border: none !important;
            box-shadow: none !important;
            border-bottom: 1px dashed #000 !important;
            border-radius: 0 !important;
            padding: 0 0 10px 0 !important;
            margin-bottom: 10px !important;
            max-width: 100% !important;
        }

        .card-info .card-title,
        .card-info .card-subtitle,
        .card-info .card-text {
            color: #000000 !important;
            font-size: 11px !important;
            font-weight: normal !important;
            margin-bottom: 4px !important;
        }

        .table-container {
            border: none !important;
            box-shadow: none !important;
            border-radius: 0 !important;
            margin-top: 0 !important;
            background: transparent !important;
        }

        .table-custom {
            width: 100% !important;
        }

        .table-custom thead {
            background-color: transparent !important;
            border-bottom: 1px dashed #000 !important;
            border-top: 1px dashed #000 !important;
        }

        .table-custom thead th {
            color: #000000 !important;
            padding: 5px 0 !important;
            font-size: 11px !important;
            text-transform: uppercase;
        }

        .table-custom tbody td, 
        .table-custom tbody th {
            padding: 6px 0 !important;
            color: #000000 !important;
            border-bottom: 1px dashed #eee !important;
            font-size: 11px !important;
        }

        .table-custom tbody tr:hover {
            background-color: transparent !important;
        }
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

    <div class="mt-4 d-flex gap-2">
        <a href="{{ route('penjualan.index') }}" class="btn-pink-back">
            &larr; Kembali
        </a>
        <button onclick="window.print()" class="btn-pink-print">
            Cetak Struk
        </button>
    </div>
</div>
@endsection