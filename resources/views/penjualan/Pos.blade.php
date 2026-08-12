@extends('layouts.app')

@section('title', 'POS - Tambah Penjualan')

@section('content')

<style>
    body {
        background-color: #fdf2f8;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #334155;
    }

    .pos-container {
        max-width: 1300px;
        margin: 20px auto;
        padding: 0 15px;
    }

    .page-title {
        color: #9d174d;
        font-weight: 800;
        font-size: 22px;
        margin-bottom: 20px;
    }

    /* Card Box Custom */
    .pink-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(244, 114, 182, 0.08);
        border: 1px solid #fbcfe8;
        overflow: hidden;
    }

    /* Scrollbar List Produk */
    .produk-scroll-container {
        max-height: 70vh;
        overflow-y: auto;
        padding: 20px;
    }

    .produk-scroll-container::-webkit-scrollbar {
        width: 6px;
    }
    .produk-scroll-container::-webkit-scrollbar-thumb {
        background: #f472b6;
        border-radius: 10px;
    }
    .produk-scroll-container::-webkit-scrollbar-track {
        background: #fce7f3;
    }

    /* Input Search Custom */
    .form-control-pink {
        width: 100%;
        padding: 10px 16px;
        border: 1.5px solid #fbcfe8;
        background-color: #fff5f8;
        border-radius: 12px;
        font-size: 14px;
        color: #475569;
        outline: none;
        transition: all 0.25s ease;
    }

    .form-control-pink:focus {
        border-color: #f472b6;
        background-color: #ffffff;
        box-shadow: 0 0 0 3px rgba(244, 114, 182, 0.2);
    }

    /* Item Produk Card */
    .produk-card-btn {
        background: #fff5f8;
        border: 1.5px solid #fbcfe8;
        border-radius: 14px;
        transition: all 0.2s ease;
        text-align: left;
    }

    .produk-card-btn:hover:not(:disabled) {
        border-color: #f472b6;
        background: #ffffff;
        box-shadow: 0 4px 12px rgba(244, 114, 182, 0.15);
    }

    /* Tombol Tambah (+) Pink */
    .btn-pink-add {
        background: linear-gradient(135deg, #f472b6, #ec4899);
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: bold;
        font-size: 18px;
        transition: all 0.2s ease;
        box-shadow: 0 4px 10px rgba(244, 114, 182, 0.3);
    }

    .btn-pink-add:hover:not(:disabled) {
        background: linear-gradient(135deg, #ec4899, #be185d);
        color: white;
    }

    /* Tabel Keranjang */
    .table-pink-cart {
        width: 100%;
        margin-bottom: 0;
    }

    .table-pink-cart th {
        background-color: #fdf2f8;
        color: #831843;
        font-weight: 700;
        font-size: 13px;
        padding: 14px;
        border-bottom: 2px solid #fbcfe8;
    }

    .table-pink-cart td {
        padding: 12px 14px;
        font-size: 13px;
        border-bottom: 1px solid #fce7f3;
        vertical-align: middle;
    }

    /* Footer / Total Section */
    .cart-footer-pink {
        background: #ffffff;
        padding: 20px;
        border-top: 2px dashed #fbcfe8;
    }

    .total-text-pink {
        color: #831843;
        font-size: 18px;
        font-weight: 800;
    }

    /* Tombol Checkout & Batal */
    .btn-checkout-pink {
        background: linear-gradient(135deg, #f472b6, #ec4899);
        color: white;
        border: none;
        padding: 12px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 15px;
        box-shadow: 0 4px 12px rgba(244, 114, 182, 0.35);
        transition: all 0.25s ease;
    }

    .btn-checkout-pink:hover:not(:disabled) {
        background: linear-gradient(135deg, #ec4899, #be185d);
        color: white;
        transform: translateY(-1px);
    }

    .btn-batal-pink {
        background-color: #fff1f2;
        color: #e11d48;
        border: 1.5px solid #fecdd3;
        padding: 11px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 14px;
        transition: all 0.25s ease;
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

    .btn-batal-pink:hover {
        background-color: #ffe4e6;
        color: #be123c;
    }
</style>

<div class="pos-container">

    @if(session('errors'))
        <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-3" style="background-color: #ffe4e6; color: #9f1239;">
            {{ session('errors') }}
        </div>
    @endif

    <h4 class="page-title">Tambah Penjualan</h4>

    <div class="row g-4">

        {{-- ===== PRODUK ===== --}}
        <div class="col-md-6">
            <div class="pink-card">
                <div class="produk-scroll-container">

                    <div class="mb-3">
                        <form method="GET" action="{{ route('penjualan.create') }}">
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control-pink"
                                placeholder="Cari produk..."
                                onkeyup="this.form.submit()">
                        </form>
                    </div>

                    @foreach ($products as $product)
                        <form method="POST"
                              action="{{ route('itempenjualan.store') }}"
                              class="row mb-3 g-2 align-items-center">
                            @csrf

                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="col-7">
                                <button
                                    type="submit"
                                    class="btn produk-card-btn w-100 p-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}"
                                    {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                                    <div class="d-flex align-items-center gap-2">

                                        <img src="{{ asset('storage/'.$product->foto) }}"
                                             alt="Gambar"
                                             class="rounded-3"
                                             style="width:45px; height:45px; object-fit:cover; border: 1px solid #fbcfe8;">

                                        <div>
                                            <div class="fw-semibold text-dark" style="font-size: 14px;">{{ $product->nama }}</div>
                                            <small style="color: #be185d; font-weight: 600;">
                                                Rp {{ number_format($product->harga_jual) }}
                                            </small>
                                        </div>

                                    </div>
                                </button>
                            </div>

                            <div class="col-3">
                                <input type="number"
                                       name="quantity"
                                       value="1"
                                       min="1"
                                       class="form-control-pink text-center"
                                       {{ $sale->status === 'COMPLETED' ? 'readonly' : '' }}>
                            </div>

                            <div class="col-2">
                                <button
                                    type="submit"
                                    class="btn btn-pink-add w-100 h-100 d-flex align-items-center justify-content-center p-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}"
                                    {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                                    +
                                </button>
                            </div>
                        </form>
                    @endforeach

                </div>
            </div>
        </div>

        {{-- ===== KERANJANG ===== --}}
        <div class="col-md-6">
            <div class="pink-card">
                <div class="table-responsive">
                    <table class="table table-pink-cart">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th style="width: 80px;">Qty</th>
                                <th>Subtotal</th>
                                <th style="width: 60px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sale->itempenjualan as $item)
                                <tr>
                                    <td class="fw-semibold text-dark">{{ $item->produk->nama }}</td>
                                    <td>Rp {{ number_format($item->produk->harga_jual) }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="number"
                                                   name="quantity"
                                                   value="{{ $item->kuantitas }}"
                                                   class="form-control-pink text-center p-1"
                                                   style="font-size: 13px;"
                                                   onchange="this.form.submit()">
                                        </form>
                                    </td>
                                    <td class="fw-bold" style="color: #be185d;">Rp {{ number_format($item->subtotal) }}</td>
                                    <td>
                                        @can('delete',$item)
                                            <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm rounded-2 px-2 py-1" style="font-size: 12px; background-color: #f43f5e; border: none;">Hapus</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        Keranjang kosong
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="cart-footer-pink">
                    <div class="total-text-pink mb-2">
                        Total: Rp {{ number_format($sale->total_pembayaran) }}
                    </div>

                    <form method="POST" 
                          action="{{ route('penjualan.update', $sale->id) }}"
                          onsubmit="return confirm('Yakin ingin checkout?')" class="mt-2">
                        @csrf
                        @method('PUT')
                        <select name="payment_method" class="form-control-pink mb-3">
                            <option value="">Pilih Pembayaran</option>
                            <option value="CASH">CASH</option>
                            <option value="QRIS">QRIS</option>
                        </select>

                        <button class="btn btn-checkout-pink w-100" {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                            Checkout
                        </button>
                    </form>

                    @can('delete', $sale)
                        <form action="{{ route('penjualan.destroy', $sale->id) }}"
                              method="POST" 
                              onsubmit="return confirm('Yakin ingin membatalkan transaksi?')"
                              class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-batal-pink w-100">
                                Batal Transaksi
                            </button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>

    </div>

     <div class="mt-4">
        <a href="{{ route('penjualan.index') }}" class="btn-pink-back">
            &larr; Kembali
        </a>
    </div>

</div>

@endsection