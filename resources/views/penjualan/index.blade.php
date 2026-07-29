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

    box-shadow:
    0 8px 25px rgba(56,189,248,.25);
}


.navbar-brand {
    color:white !important;
    font-size:24px;
    font-weight:700;
}


.navbar a {
    color:white !important;
}


.navbar a:hover {
    color:#E0F2FE !important;
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
}

/* Hover baris */
table tbody tr:hover {
    background: #fff0f6;
}

/* Tombol aksi */
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

<a href="{{ route('penjualan.create') }}" class="btn btn-primary mb-3">Create</a>

<form action="{{ route('penjualan.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input
            type="text"
            name="search"
            value="{{ request()->search }}"
            class="form-control"
            placeholder="Search penjualan"
        >
        <button class="btn btn-outline-secondary" type="submit">
            Search
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
                <td>Rp {{ number_format($sale->total_pembayaran,) }}</td>
                <td>{{ $sale->metode_pembayaran }}</td>
                <td>{{ $sale->status }}</td>
                <td class="d-flex gap-1">
                    <a href="{{ route ('penjualan.show', $sale) }}" class="btn btn-info">Detail</a>
                    @can('view', $sale)
                    |||
                    <a href="" class="btn btn-warning btn-sm">Edit</a> 
                    |||
                            |||
                            <a href="{{ route('penjualan.edit', $sale) }}" method="POST" class="d-inline">
                        @endcan
                        
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">Data Tidak Ditemukan</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $sales->links() }}

@endsection
