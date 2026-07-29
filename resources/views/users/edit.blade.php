@extends('layouts.app')

@section('title','Edit User')

@section('content')
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

 <h4>Edit User</h4>

 <form action="{{ route('admin.users.update', $user) }}" method="post">
 @include('users._form')   
</form>
@endsection