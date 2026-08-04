@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')

<style>
    body {
        background-color: #fff1f7;
    }

    .edit-card-container {
        max-width: 650px;
        margin: 30px auto;
    }

    .edit-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 30px;
        border: 1px solid #fbcfe8;
        box-shadow: 0 10px 25px rgba(236, 72, 153, 0.08);
    }

    .page-title {
        color: #be185d;
        font-weight: 700;
        margin-bottom: 24px;
    }

    .form-label-pink {
        color: #9d174d;
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 6px;
    }

    .form-control-pink {
        border: 1.5px solid #fbcfe8;
        border-radius: 12px;
        padding: 10px 14px;
        color: #334155;
        transition: all 0.2s ease;
    }

    .form-control-pink:focus {
        border-color: #f472b6;
        box-shadow: 0 0 0 0.2rem rgba(244,114,182,.25);
        outline:none;
    }

    .photo-preview-box {
        width:100px;
        height:100px;
        border-radius:12px;
        border:1.5px dashed #fbcfe8;
        background:#fff0f6;
        display:flex;
        align-items:center;
        justify-content:center;
        overflow:hidden;
    }

    .photo-preview-box img {
        width:100%;
        height:100%;
        object-fit:cover;
    }

    .no-img-text {
        font-size:.75rem;
        color:#be185d;
        font-weight:600;
        text-align:center;
    }

    .input-file-pink::file-selector-button {
        background:#fce7f3;
        color:#be185d;
        border:none;
        padding:8px 14px;
        border-radius:8px;
        font-weight:600;
        cursor:pointer;
        margin-right:10px;
    }

    .btn-pink-submit {
        background:#f472b6;
        color:white;
        font-weight:600;
        border:none;
        border-radius:12px;
        padding:10px 24px;
    }

    .btn-pink-outline {
        background:#fce7f3;
        color:#be185d;
        font-weight:600;
        border:none;
        border-radius:12px;
        padding:10px 20px;
        text-decoration:none;
    }
</style>

<div class="container">
    <div class="edit-card-container">
        <div class="edit-card">

            <h3 class="page-title">Edit Produk</h3>

            <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- FOTO SAAT INI --}}
                <div class="mb-4">
                    <label class="form-label-pink d-block">Foto Saat Ini</label>
                    <div class="photo-preview-box">
                        @if($produk->foto && Storage::disk('public')->exists($produk->foto))
                            <img src="{{ asset('storage/'.$produk->foto) }}">
                        @else
                            <span class="no-img-text">Tidak Ada Foto</span>
                        @endif
                    </div>
                </div>

                {{-- UPLOAD FOTO BARU --}}
                <div class="mb-3">
                    <label class="form-label-pink">Pilih Gambar Baru (Opsional)</label>
                    <input type="file"
                           name="foto"
                           id="foto"
                           class="form-control form-control-pink input-file-pink"
                           accept="image/*">

                    @error('foto')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- NAMA PRODUK --}}
                <div class="mb-3">
                    <label class="form-label-pink">Nama Produk</label>
                    <input type="text"
                           name="name"
                           class="form-control form-control-pink"
                           value="{{ old('name', $produk->nama) }}"
                           required>

                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- HARGA BELI --}}
                <div class="mb-3">
                    <label class="form-label-pink">Harga Beli</label>
                    <input type="number"
                           name="purchase_price"
                           class="form-control form-control-pink"
                           value="{{ old('purchase_price', $produk->harga_beli) }}"
                           required>

                    @error('purchase_price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- HARGA JUAL --}}
                <div class="mb-3">
                    <label class="form-label-pink">Harga Jual</label>
                    <input type="number"
                           name="selling_price"
                           class="form-control form-control-pink"
                           value="{{ old('selling_price', $produk->harga_jual) }}"
                           required>

                    @error('selling_price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- STOK --}}
                <div class="mb-4">
                    <label class="form-label-pink">Stok</label>
                    <input type="number"
                           name="stok"
                           class="form-control form-control-pink"
                           value="{{ old('stok', $produk->stok) }}"
                           required>

                    @error('stok')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-pink-submit">Simpan Perubahan</button>
                <a href="{{ route('produk.index') }}" class="btn btn-pink-outline">Kembali</a>

            </form>

        </div>
    </div>
</div>

@endsection