@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<style>
    /* Background seluruh halaman */
    body {
        background-color: #fff1f7;
    }

    /* Container Card untuk Form */
    .card-edit-user {
        background: #ffffff;
        border: 2px solid #fbcfe8;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(236, 72, 153, 0.12);
        padding: 30px;
        max-width: 700px;
        margin: 20px auto;
    }

    /* Judul Halaman */
    .card-edit-user h4 {
        color: #ec4899;
        font-weight: 700;
        margin-bottom: 25px;
        font-size: 24px;
        border-bottom: 2px solid #fce7f3;
        padding-bottom: 10px;
    }

    /* Styling Input Text, Email, Password, dan Select Box */
    .card-edit-user input[type="text"],
    .card-edit-user input[type="email"],
    .card-edit-user input[type="password"],
    .card-edit-user select {
        border: 2px solid #f9a8d4 !important;
        border-radius: 12px !important;
        padding: 12px 15px !important;
        background-color: #fffafc;
        color: #475569;
        font-size: 15px;
        transition: all 0.3s ease;
    }

    /* Efek Fokus Input saat diklik */
    .card-edit-user input:focus,
    .card-edit-user select:focus {
        border-color: #ec4899 !important;
        box-shadow: 0 0 0 0.25rem rgba(236, 72, 153, 0.2) !important;
        background-color: #ffffff;
        outline: none;
    }

    /* Label Form */
    .card-edit-user .form-label {
        color: #be185d;
        font-weight: 600;
        margin-bottom: 8px;
    }

    /* Styling Tombol Simpan */
    .card-edit-user .btn-simpan,
    .card-edit-user button[type="submit"] {
        background: linear-gradient(135deg, #f472b6, #ec4899) !important;
        color: white !important;
        border: none !important;
        border-radius: 12px !important;
        padding: 10px 25px !important;
        font-weight: 600 !important;
        box-shadow: 0 4px 12px rgba(236, 72, 153, 0.3);
        transition: all 0.3s ease;
    }

    .card-edit-user .btn-simpan:hover,
    .card-edit-user button[type="submit"]:hover {
        background: linear-gradient(135deg, #ec4899, #db2777) !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(236, 72, 153, 0.4);
    }

    /* Styling Tombol Kembali */
    .card-edit-user .btn-kembali,
    .card-edit-user a.btn {
        background: #fce7f3 !important;
        color: #be185d !important;
        border: 1px solid #fbcfe8 !important;
        border-radius: 12px !important;
        padding: 10px 25px !important;
        font-weight: 600 !important;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .card-edit-user .btn-kembali:hover,
    .card-edit-user a.btn:hover {
        background: #fbcfe8 !important;
        color: #9d174d !important;
    }
</style>

<div class="card-edit-user">
    <h4>Edit User</h4>

    @if ($errors->any())
        <div class="alert alert-danger" style="background-color: #fef2f2; border: 1px solid #fecaca; color: #991b1b; border-radius: 12px; padding: 15px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        @include('users._form')    
    </form>
</div>
@endsection