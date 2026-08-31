@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')

<style>
    body {
        background-color: #fdf2f8;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #334155;
    }

    .form-container {
        max-width: 600px;
        margin: 40px auto;
        padding: 0 15px;
    }

    .page-title {
        color: #9d174d;
        font-weight: 800;
        font-size: 24px;
        margin-bottom: 24px;
        text-align: center;
    }

    .pink-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(244, 114, 182, 0.08);
        border: 1px solid #fbcfe8;
        padding: 28px;
    }

    .form-label-pink {
        font-size: 13px;
        font-weight: 600;
        color: #831843;
        margin-bottom: 6px;
        display: block;
    }

    .form-control-pink {
        width: 100%;
        padding: 10px 16px;
        border: 1.5px solid #fbcfe8;
        background-color: #fff5f8;
        border-radius: 12px;
        font-size: 14px;
        color: #334155;
        outline: none;
        transition: all 0.25s ease;
    }

    .form-control-pink:focus {
        border-color: #f472b6;
        background-color: #ffffff;
        box-shadow: 0 0 0 3px rgba(244, 114, 182, 0.2);
    }

    .input-group-pink {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-group-pink .rp-prefix {
        position: absolute;
        left: 14px;
        color: #be185d;
        font-weight: 700;
        font-size: 14px;
        pointer-events: none;
    }

    .input-group-pink .form-control-pink {
        padding-left: 42px;
    }

    .btn-simpan-pink {
        background: linear-gradient(135deg, #f472b6, #ec4899);
        color: white;
        border: none;
        padding: 12px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 15px;
        width: 100%;
        box-shadow: 0 4px 12px rgba(244, 114, 182, 0.35);
        transition: all 0.25s ease;
        cursor: pointer;
    }

    .btn-simpan-pink:hover {
        background: linear-gradient(135deg, #ec4899, #be185d);
        color: white;
        transform: translateY(-1px);
    }

    .btn-kembali-pink {
        display: block;
        text-align: center;
        background-color: #fff1f2;
        color: #be185d;
        border: 1.5px solid #fecdd3;
        padding: 11px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.25s ease;
    }

    .btn-kembali-pink:hover {
        background-color: #ffe4e6;
        color: #9f1239;
    }
</style>

<div class="form-container">

    <h4 class="page-title">Edit Produk</h4>

    <div class="pink-card">
        <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- ===== FOTO SAAT INI ===== --}}
            <div class="mb-3">
                <label class="form-label-pink">Foto Saat Ini</label>
                <div class="mb-2">
                    @if($produk->foto)
                        <img src="{{ asset('storage/' . $produk->foto) }}" alt="Foto Produk" style="width: 100px; height: 100px; object-fit: cover; border-radius: 12px; border: 1px solid #fbcfe8;">
                    @else
                        <span class="text-muted">Belum ada foto</span>
                    @endif
                </div>
            </div>

            {{-- ===== UPLOAD FOTO BARU ===== --}}
            <div class="mb-4">
                <label class="form-label-pink">Pilih Gambar Baru (Opsional)</label>
                <input type="file" name="foto" class="form-control-pink">
                @error('foto')
                    <small class="text-danger mt-1 d-block">{{ $message }}</small>
                @enderror
            </div>

            {{-- ===== NAMA PRODUK ===== --}}
            <div class="mb-3">
                <label class="form-label-pink">Nama Produk</label>
                <input type="text" 
                       name="name" 
                       value="{{ old('name', $produk->name) }}" 
                       placeholder="Masukkan nama produk" 
                       class="form-control-pink">
                @error('name')
                    <small class="text-danger mt-1 d-block">{{ $message }}</small>
                @enderror
            </div>

            {{-- ===== JENIS / BRAND PRODUK ===== --}}
            <div class="mb-3">
                <label class="form-label-pink">Jenis / Brand Produk</label>

                <select name="jenis_id" class="form-control-pink">
                    <option value="" disabled>-- Pilih Brand Produk --</option>
                    @php
                        $selectedJenis = old('jenis_id', $produk->jenis_id);
                    @endphp
                    <option value="Make Over" {{ $selectedJenis == 'Make Over' ? 'selected' : '' }}>Make Over</option>
                    <option value="Mayballine" {{ $selectedJenis == 'Mayballine' ? 'selected' : '' }}>Mayballine</option>
                    <option value="glad2glow" {{ $selectedJenis == 'glad2glow' ? 'selected' : '' }}>glad2glow</option>
                    <option value="OMG" {{ $selectedJenis == 'OMG' ? 'selected' : '' }}>OMG</option>
                    <option value="Azzura" {{ $selectedJenis == 'Azzura' ? 'selected' : '' }}>Azzura</option>
                    <option value="Skintific" {{ $selectedJenis == 'Skintific' ? 'selected' : '' }}>Skintific</option>
                    <option value="Pixy" {{ $selectedJenis == 'Pixy' ? 'selected' : '' }}>Pixy</option>
                    <option value="Emina" {{ $selectedJenis == 'Emina' ? 'selected' : '' }}>Emina</option>
                    <option value="Wardah" {{ $selectedJenis == 'Wardah' ? 'selected' : '' }}>Wardah</option>
                    <option value="Pinkplash" {{ $selectedJenis == 'Pinkplash' ? 'selected' : '' }}>Pinkplash</option>
                    <option value="Loreal" {{ $selectedJenis == 'Loreal' ? 'selected' : '' }}>Loreal</option>
                    <option value="Chanel" {{ $selectedJenis == 'Chanel' ? 'selected' : '' }}>Chanel</option>
                    <option value="Ponds" {{ $selectedJenis == 'Ponds' ? 'selected' : '' }}>Ponds</option>
                    <option value="Skincare" {{ $selectedJenis == 'Skincare' ? 'selected' : '' }}>Skincare</option>
                </select>

                @error('jenis_id')
                    <small class="text-danger mt-1 d-block">{{ $message }}</small>
                @enderror
            </div>

            {{-- ===== HARGA BELI ===== --}}
            <div class="mb-3">
                <label class="form-label-pink">Harga Beli</label>
                <div class="input-group-pink">
                    <span class="rp-prefix">Rp</span>
                    <input type="number" 
                           name="purchase_price" 
                           value="{{ old('purchase_price', $produk->purchase_price) }}" 
                           placeholder="0" 
                           class="form-control-pink">
                </div>
                @error('purchase_price')
                    <small class="text-danger mt-1 d-block">{{ $message }}</small>
                @enderror
            </div>

            {{-- ===== HARGA JUAL ===== --}}
            <div class="mb-3">
                <label class="form-label-pink">Harga Jual</label>
                <div class="input-group-pink">
                    <span class="rp-prefix">Rp</span>
                    <input type="number" 
                           name="selling_price" 
                           value="{{ old('selling_price', $produk->selling_price) }}" 
                           placeholder="0" 
                           class="form-control-pink"
                           style="font-weight: 700; color: #be185d;">
                </div>
                @error('selling_price')
                    <small class="text-danger mt-1 d-block">{{ $message }}</small>
                @enderror
            </div>

            {{-- ===== STOK ===== --}}
            <div class="mb-4">
                <label class="form-label-pink">Stok</label>
                <input type="number" 
                       name="stok" 
                       value="{{ old('stok', $produk->stok) }}" 
                       placeholder="Masukkan jumlah stok" 
                       class="form-control-pink">
                @error('stok')
                    <small class="text-danger mt-1 d-block">{{ $message }}</small>
                @enderror
            </div>

            {{-- ===== TOMBOL AKSI ===== --}}
            <div class="d-grid gap-2 pt-2">
                <button type="submit" class="btn-simpan-pink">
                    Simpan Perubahan
                </button>

                <a href="{{ route('produk.index') }}" class="btn-kembali-pink mt-1">
                    ← Kembali
                </a>
            </div>

        </form>
    </div>

</div>

@endsection