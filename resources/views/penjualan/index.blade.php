@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

@include('layouts.navbar')

<style>
/* Background halaman produk */
body {
    background: #fff1f7;
}

.navbar {
    background: linear-gradient(
        135deg,
        #e48ffc,
        #f9f9f9
    );

    box-shadow: 0 8px 25px rgba(56,189,248,.25);
}

.navbar-brand {
    color: white !important;
    font-size: 24px;
    font-weight: 700;
}

.navbar a {
    color: white !important;
}

.navbar a:hover {
    color: #E0F2FE !important;
}

/* Judul halaman */
h1, h2 {
    color: #ec4899;
    font-weight: 700;
}

/* Input search */
input[type="text"] {
    border: 2px solid #f9a8d4;
    border-radius: 10px;
    padding: 10px;
}

input[type="text"]:focus {
    border-color: #ec4899;
    outline: none;
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(236,72,153,0.15);
}

/* Header tabel */
table thead {
    background: #fbcfe8;
}

table thead th {
    color: #be185d;
    padding: 15px;
    font-weight: 700;
}

/* Isi tabel */
table tbody td {
    padding: 12px;
    color: #475569;
    border-bottom: 1px solid #fce7f3;
    vertical-align: middle;
}

/* Hover baris */
table tbody tr:hover {
    background: #fff0f6;
}

/* Tombol dasar */
button, .btn {
    background: #f472b6;
    color: white;
    border: none;
    border-radius: 10px;
    padding: 8px 15px;
    cursor: pointer;
}

button:hover, .btn:hover {
    background: #ec4899;
}

/* Custom Tombol Aksi */
.action-group {
    display: flex;
    align-items: center;
    gap: 6px;
}

.btn-pink-detail {
    background-color: #ec4899;
    color: white !important;
    font-weight: 500;
    padding: 6px 12px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 13px;
    transition: all 0.2s ease;
}

.btn-pink-detail:hover {
    background-color: #be185d;
}

.btn-amber-edit {
    background-color: #fef08a;
    color: #854d0e !important;
    font-weight: 500;
    padding: 6px 12px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 13px;
    border: 1px solid #fde047;
    transition: all 0.2s ease;
}

.btn-amber-edit:hover {
    background-color: #eab308;
    color: white !important;
}

.btn-rose-delete {
    background-color: #fecdd3;
    color: #9f1239;
    font-weight: 500;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 13px;
    border: 1px solid #fda4af;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-rose-delete:hover {
    background-color: #e11d48;
    color: white;
}

/* Pagination */
.pagination a,
.pagination span {
    color: #ec4899;
}
</style>

@if(session('errors'))
    <div class="alert alert-danger">
        {{ session('errors') }}
    </div>
@endif

<h1>Halaman Penjualan</h1>

<a href="{{ route('penjualan.create') }}" class="btn btn-primary mb-3">Buat Penjualan</a>

<form action="{{ route('penjualan.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input
            type="text"
            name="search"
            value="{{ request()->search }}"
            class="form-control"
            placeholder="Cari penjualan..."
        >
        <button class="btn btn-outline-secondary" type="submit">
            Cari
        </button>
    </div>
</form>

<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Transaksi</th>
            <th>Kasir</th>
            <th>Total Penjualan</th>
            <th>Metode Pembayaran</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($sales as $sale)
            <tr>
                <td>{{ $sales->firstItem() + $loop->index }}</td>
                <td>{{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}</td>
                <td>{{ $sale->user->name ?? '-' }}</td>
                <td>Rp {{ number_format($sale->total_pembayaran) }}</td>
                <td>{{ $sale->metode_pembayaran }}</td>
                
                <td>
                    @if(strtoupper($sale->status) == 'OPEN')
                        TERBUKA
                    @elseif(strtoupper($sale->status) == 'COMPLETED')
                        SELESAI
                    @else
                        {{ $sale->status }}
                    @endif
                </td>

                <td>
                    <div class="action-group">
                        {{-- Tombol Detail --}}
                        <a href="{{ route('penjualan.show', $sale) }}" class="btn-pink-detail">
                            Detail
                        </a>
                        
                        {{-- Tombol Edit & Hapus hanya tampil jika status BUKAN COMPLETED --}}
                        @if(strtoupper($sale->status) !== 'COMPLETED')
                            {{-- Tombol Edit --}}
                            <a href="{{ route('penjualan.edit', $sale) }}" class="btn-amber-edit">
                                Edit
                            </a>

                            {{-- Tombol Hapus --}}
                            <form action="{{ route('penjualan.destroy', $sale) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data penjualan ini?');" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-rose-delete">
                                    Hapus
                                </button>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">Data Tidak Ditemukan</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-3">
    {{ $sales->links() }}
</div>

@endsection