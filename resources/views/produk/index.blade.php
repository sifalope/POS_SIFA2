@extends('layouts.app')

@section('title', 'Produk')

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

<h1>Selamat Datang Di Halaman Produk</h1>

@if (session('success'))
    <div class="alert alert-success" style="background-color: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; border-radius: 12px; padding: 15px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
@endif

@can('create', App\Models\Produk::class)
 <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">create</a>
@endcan

<form action="{{ route('produk.index') }}" method="GET" class="mb-3">
  <div class="input-group">
    <input 
      type="text"
      name="search"
      value="{{ request('search') }}"
      class="form-control"
      placeholder="Search nama produk"
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
      <th>User</th>
      <th>Foto</th>
      <th>Nama</th>
      <th>Harga Beli</th>
      <th>Harga Jual</th>
      <th>Stok</th>
      <th>Aksi</th>
    </tr>
  </thead>

  <tbody>
    @forelse ($products as $product)
      <tr>
        <th scope="row">{{ $products->firstItem() + $loop->index }}</th>
        <td>{{ $product->user?->name ?? '-' }}</td>
        <td>
              <img src="{{ asset('storage/' . $product->foto) }}" 
                  width="100"
                  class="img-thumbnail">
        </td>
        <td>{{ $product->nama }}</td>
        <td>{{ $product->harga_beli }}</td>
        <td>{{ $product->harga_jual }}</td>
        <td>{{ $product->stok }}</td>
        <td class="d-flex gap-1">
            <a href="{{ route('produk.show', $product) }}" class="btn btn-warning ">Detail</a>
          @can('update', $product)
           <a href="{{ route('produk.edit', $product) }}" class="btn btn-warning ">Edit</a>
          @endcan
        @can('delete', $product)
          <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" onclick="return confirm('Yakin hapus produk ini??')">
              Hapus
            </button>
          </form>
        @endcan
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="8" class="text-center">
          <h5 class="mb-3">Data Tidak Tersedia.</h5>
        </td>
      </tr>
    @endforelse
  </tbody>
</table>

{{ $products->links() }}

@endsection