@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<style>
    /* Background Halaman */
    body {
        background-color: #fff1f7;
    }

    /* Container Card Form */
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

    /* Form Label & Input Styling */
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
        box-shadow: 0 0 0 0.2rem rgba(244, 114, 182, 0.25);
        outline: none;
    }

    /* Frame Gambar / Preview */
    .photo-preview-box {
        width: 100px;
        height: 100px;
        border-radius: 12px;
        border: 1.5px dashed #fbcfe8;
        background-color: #fff0f6;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .photo-preview-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .no-img-text {
        font-size: 0.75rem;
        color: #be185d;
        font-weight: 600;
        text-align: center;
    }

    /* Styling Input File Custom */
    .input-file-pink::file-selector-button {
        background-color: #fce7f3;
        color: #be185d;
        border: none;
        padding: 8px 14px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        margin-right: 10px;
        transition: background 0.2s;
    }

    .input-file-pink::file-selector-button:hover {
        background-color: #fbcfe8;
    }

    /* Tombol-tombol */
    .btn-pink-submit {
        background-color: #f472b6;
        color: #ffffff;
        font-weight: 600;
        border: none;
        border-radius: 12px;
        padding: 10px 24px;
        transition: all 0.2s;
        box-shadow: 0 4px 12px rgba(244, 114, 182, 0.3);
    }

    .btn-pink-submit:hover {
        background-color: #ec4899;
        color: #ffffff;
    }

    .btn-pink-outline {
        background-color: #fce7f3;
        color: #be185d;
        font-weight: 600;
        border: none;
        border-radius: 12px;
        padding: 10px 20px;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-pink-outline:hover {
        background-color: #fbcfe8;
        color: #9d174d;
    }
</style>

<div class="container">
    <div class="edit-card-container">
        <div class="edit-card">
            <h3 class="page-title">Edit Produk</h3>

            <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <div class="col-6">
                        <label class="form-label-pink d-block">Foto Saat Ini</label>
                        <div class="photo-preview-box">
                            @if(!empty($produk->foto) && Storage::disk('public')->exists($produk->foto))
                                <img src="{{ asset('storage/' . $produk->foto) }}" alt="Foto Produk">
                            @else
                                <span class="no-img-text">Tidak Ada Foto</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="form-label-pink d-block">Preview Foto Baru</label>
                        <div class="photo-preview-box">
                            <img id="imgPreview" src="#" alt="Preview Foto" style="display: none;">
                            <span id="previewPlaceholder" class="no-img-text">Belum Dipilih</span>
                        </div>
                    </div>
                </div>

                {{-- FOTO (foto) --}}
                <div class="mb-3">
                    <label for="foto" class="form-label form-label-pink">Pilih Gambar Baru (Opsional)</label>
                    <input type="file" class="form-control form-control-pink input-file-pink" id="foto" name="foto" accept="image/*" onchange="previewImage(event)">
                    @error('foto')
                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                    @enderror
                </div>

                {{-- NAMA PRODUK (name) --}}
                <div class="mb-3">
                    <label for="name" class="form-label form-label-pink">Nama Produk</label>
                    <input type="text" class="form-control form-control-pink" id="name" name="name" value="{{ old('name', $produk->nama ?? $produk->nama_produk) }}" required>
                    @error('name')
                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                    @enderror
                </div>

                {{-- HARGA BELI (purchase_price) --}}
                <div class="mb-3">
                    <label for="purchase_price" class="form-label form-label-pink">Harga Beli</label>
                    <input type="number" class="form-control form-control-pink" id="purchase_price" name="purchase_price" value="{{ old('purchase_price', $produk->harga_beli) }}" required>
                    @error('purchase_price')
                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                    @enderror
                </div>

                {{-- HARGA JUAL (selling_price) --}}
                <div class="mb-3">
                    <label for="selling_price" class="form-label form-label-pink">Harga Jual</label>
                    <input type="number" class="form-control form-control-pink" id="selling_price" name="selling_price" value="{{ old('selling_price', $produk->harga_jual) }}" required>
                    @error('selling_price')
                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                    @enderror
                </div>

                {{-- STOK (stok) --}}
                <div class="mb-4">
                    <label for="stok" class="form-label form-label-pink">Stok</label>
                    <input type="number" class="form-control form-control-pink" id="stok" name="stok" value="{{ old('stok', $produk->stok) }}" required>
                    @error('stok')
                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-pink-submit">Simpan Perubahan</button>
                    <a href="{{ route('produk.index') }}" class="btn btn-pink-outline">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('imgPreview');
        const placeholder = document.getElementById('previewPlaceholder');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                placeholder.style.display = 'none';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection