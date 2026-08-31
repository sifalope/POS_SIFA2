@extends('layouts.app')

@section('title', 'Users')

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

<div class="container mt-4">
    <h1>Halaman Users</h1>

    @if (session('success'))
        <div class="alert alert-success" style="background-color: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; border-radius: 12px; padding: 15px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.users.create')}}" class="btn btn-primary mb-3">Tambah User</a>

    <form action="{{ route('admin.users') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                class="form-control"
                placeholder="Search username or email"
            >
            <button class="btn btn-outline-secondary" type="submit">
                Search
            </button>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $users->firstItem() + $loop->index }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name ?? '-' }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                        Edit Akun
                    </a>
                    ||
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus user ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>
@endsection