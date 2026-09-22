@extends('layouts.app')

@section('title', 'Tambah Produk')

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

    .input-group-pink .percent-suffix {
        position: absolute;
        right: 14px;
        color: #be185d;
        font-weight: 700;
        font-size: 14px;
        pointer-events: none;
    }

    .input-group-pink .form-control-pink {
        padding-left: 42px;
    }

    .input-group-pink .form-control-diskon {
        padding-left: 16px;
        padding-right: 42px;
    }

    .upload-box-pink {
        width: 100%;
        height: 180px;
        background-color: #fff5f8;
        border: 2px dashed #fbcfe8;
        border-radius: 16px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: relative;
        cursor: pointer;
        overflow: hidden;
        transition: all 0.25s ease;
    }

    .upload-box-pink:hover {
        background-color: #fce7f3;
        border-color: #f472b6;
    }

    .upload-box-pink input[type="file"] {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        top: 0;
        left: 0;
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

    <h4 class="page-title">Tambah Produk</h4>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert" style="border-radius: 12px;">
            <strong>Gagal!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="pink-card">
        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" id="formProduk">
            @csrf

            {{-- ===== UPLOAD FOTO ===== --}}
            <div class="mb-4">
                <label class="form-label-pink">Gambar Produk</label>
                
                <div class="upload-box-pink">
                    <img id="imgPreview" class="d-none w-100 h-100" style="object-fit: cover;" alt="Preview Foto">
                    
                    <div id="placeholderText" class="text-center p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="#f472b6" class="bi bi-image mb-2" viewBox="0 0 16 16">
                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                            <path d="M2.002 1a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h12z"/>
                        </svg>
                        <div class="fw-bold" style="color: #be185d; font-size: 14px;">Klik untuk pilih / Unggah Foto</div>
                    </div>

                    <input type="file" name="foto" id="fotoInput" onchange="previewImage()">
                </div>

                @error('foto')
                    <small class="text-danger mt-1 d-block">{{ $message }}</small>
                @enderror
            </div>

            {{-- ===== NAMA PRODUK ===== --}}
            <div class="mb-3">
                <label class="form-label-pink">Nama Produk</label>
                <input type="text" 
                       name="name" 
                       value="{{ old('name') }}" 
                       placeholder="Masukkan nama produk" 
                       class="form-control-pink">
                
                @error('name')
                    <small class="text-danger mt-1 d-block">{{ $message }}</small>
                @enderror
            </div>

            {{-- ===== BRAND / JENIS PRODUK ===== --}}
            <div class="mb-3">
                <label class="form-label-pink">Brand Produk</label>

                <select name="jenis_id" class="form-control-pink">
                    <option value="" disabled selected>-- Pilih Brand Produk --</option>
                    <option value="Make Over" {{ old('jenis_id') == 'Make Over' ? 'selected' : '' }}>Make Over</option>
                    <option value="Mayballine" {{ old('jenis_id') == 'Mayballine' ? 'selected' : '' }}>Mayballine</option>
                    <option value="glad2glow" {{ old('jenis_id') == 'glad2glow' ? 'selected' : '' }}>glad2glow</option>
                    <option value="OMG" {{ old('jenis_id') == 'OMG' ? 'selected' : '' }}>OMG</option>
                    <option value="Azzura" {{ old('jenis_id') == 'Azzura' ? 'selected' : '' }}>Azzura</option>
                    <option value="Skintific" {{ old('jenis_id') == 'Skintific' ? 'selected' : '' }}>Skintific</option>
                    <option value="Pixy" {{ old('jenis_id') == 'Pixy' ? 'selected' : '' }}>Pixy</option>
                    <option value="Emina" {{ old('jenis_id') == 'Emina' ? 'selected' : '' }}>Emina</option>
                    <option value="Wardah" {{ old('jenis_id') == 'Wardah' ? 'selected' : '' }}>Wardah</option>
                    <option value="Pinkplash" {{ old('jenis_id') == 'Pinkplash' ? 'selected' : '' }}>Pinkplash</option>
                    <option value="Loreal" {{ old('jenis_id') == 'Loreal' ? 'selected' : '' }}>Loreal</option>
                    <option value="Chanel" {{ old('jenis_id') == 'Chanel' ? 'selected' : '' }}>Chanel</option>
                    <option value="Ponds" {{ old('jenis_id') == 'Ponds' ? 'selected' : '' }}>Ponds</option>
                    <option value="Skincare" {{ old('jenis_id') == 'Skincare' ? 'selected' : '' }}>Skincare</option>
                </select>

                @error('jenis_id')
                    <small class="text-danger mt-1 d-block">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            {{-- ===== HARGA BELI ===== --}}
            <div class="mb-3">
                <label class="form-label-pink">Harga Beli</label>
                <div class="input-group-pink">
                    <span class="rp-prefix">Rp</span>
                    <input type="number" 
                           name="purchase_price" 
                           value="{{ old('purchase_price') }}" 
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
                           id="hargaJualInput"
                           name="selling_price" 
                           value="{{ old('selling_price') }}" 
                           placeholder="0" 
                           class="form-control-pink"
                           style="font-weight: 700; color: #be185d;">
                </div>

                @error('selling_price')
                    <small class="text-danger mt-1 d-block">{{ $message }}</small>
                @enderror
            </div>

            {{-- ===== STOK PRODUK ===== --}}
            <div class="mb-3">
                <label class="form-label-pink">Stok Produk</label>
                <input type="number" 
                       id="stokInput"
                       name="stok" 
                       min="0"
                       value="{{ old('stok', 1) }}" 
                       placeholder="Masukkan jumlah stok awal" 
                       class="form-control-pink"
                       required>

                {{-- Tulisan petunjuk stok --}}
                <small class="text-muted mt-1 d-block" style="font-size: 12px;">
                    * Masukkan jumlah stok awal produk. Jika diisi 0, status produk di kasir akan langsung tampil <strong>"Stok Habis"</strong>.
                </small>

                {{-- Peringatan real-time saat user mengetik stok --}}
                <div id="stokStatusInfo" class="mt-1">
                    <small id="stokWarning" class="text-danger d-none fw-bold" style="font-size: 12px;">
                        ⚠️ Stok tidak boleh minus!
                    </small>
                    <small id="stokHabisInfo" class="text-warning d-none fw-bold" style="font-size: 12px; color: #d97706 !important;">
                        ⚠️ Stok bernilai 0. Produk ini akan ditandai "Stok Habis" di kasir.
                    </small>
                </div>

                @error('stok')
                    <small class="text-danger mt-1 d-block">{{ $message }}</small>
                @enderror
            </div>

            {{-- ===== DISKON PRODUK ===== --}}
            <div class="mb-4">
                <label class="form-label-pink">Diskon Produk</label>
                <div class="row g-2">
                    <div class="col-5">
                        <select id="pilihanDiskon" class="form-control-pink">
                            <option value="0">Tanpa Diskon (0%)</option>
                            <option value="10">Diskon 10%</option>
                            <option value="custom">Kustom (%)</option>
                        </select>
                    </div>
                    <div class="col-7">
                        <div class="input-group-pink">
                            <input type="number" 
                                   id="inputDiskonNilai"
                                   name="diskon" 
                                   value="{{ old('diskon', 0) }}" 
                                   placeholder="0" 
                                   min="0"
                                   max="100"
                                   class="form-control-pink form-control-diskon">
                            <span class="percent-suffix">%</span>
                        </div>
                    </div>
                </div>

                {{-- Preview Harga Setelah Diskon --}}
                <div class="mt-2 p-2 rounded-3 text-end" style="background-color: #fff5f8; border: 1px dashed #fbcfe8;">
                    <small class="text-muted">Harga Setelah Diskon: </small>
                    <span id="labelHargaSetelahDiskon" class="fw-bold" style="color: #be185d;">Rp 0</span>
                </div>

                @error('diskon')
                    <small class="text-danger mt-1 d-block">{{ $message }}</small>
                @enderror
            </div>

            {{-- ===== TOMBOL AKSI ===== --}}
            <div class="d-grid gap-2 pt-2">
                <button type="submit" class="btn-simpan-pink">
                    Simpan Produk
                </button>

                <a href="{{ route('produk.index') }}" class="btn-kembali-pink mt-1">
                    ← Kembali
                </a>
            </div>

        </form>
    </div>

</div>

<script>
    function previewImage() {
        const input = document.getElementById('fotoInput');
        const preview = document.getElementById('imgPreview');
        const text = document.getElementById('placeholderText');

        const [file] = input.files;
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
            text.classList.add('d-none');
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const hargaJualInput = document.getElementById('hargaJualInput');
        const pilihanDiskon = document.getElementById('pilihanDiskon');
        const inputDiskonNilai = document.getElementById('inputDiskonNilai');
        const labelHargaSetelahDiskon = document.getElementById('labelHargaSetelahDiskon');
        
        const stokInput = document.getElementById('stokInput');
        const stokWarning = document.getElementById('stokWarning');
        const stokHabisInfo = document.getElementById('stokHabisInfo');

        // Logic pengecekan status stok secara real-time
        function checkStokStatus() {
            const val = parseInt(stokInput.value);
            stokWarning.classList.add('d-none');
            stokHabisInfo.classList.add('d-none');

            if (isNaN(val) || val < 0) {
                stokWarning.classList.remove('d-none');
            } else if (val === 0) {
                stokHabisInfo.classList.remove('d-none');
            }
        }

        stokInput.addEventListener('input', checkStokStatus);
        checkStokStatus(); // Jalankan saat pertama kali halaman dimuat

        const initialDiskon = parseFloat(inputDiskonNilai.value) || 0;
        if (initialDiskon === 10) {
            pilihanDiskon.value = "10";
            inputDiskonNilai.readOnly = true;
        } else if (initialDiskon === 0) {
            pilihanDiskon.value = "0";
            inputDiskonNilai.readOnly = true;
        } else {
            pilihanDiskon.value = "custom";
            inputDiskonNilai.readOnly = false;
        }

        function hitungHargaDiskon() {
            const harga = parseFloat(hargaJualInput.value) || 0;
            const diskon = parseFloat(inputDiskonNilai.value) || 0;
            const hargaAkhir = harga - (harga * (diskon / 100));

            labelHargaSetelahDiskon.textContent = 'Rp ' + Math.round(hargaAkhir).toLocaleString('id-ID');
        }

        pilihanDiskon.addEventListener('change', function () {
            if (this.value === "10") {
                inputDiskonNilai.value = 10;
                inputDiskonNilai.readOnly = true;
            } else if (this.value === "0") {
                inputDiskonNilai.value = 0;
                inputDiskonNilai.readOnly = true;
            } else {
                inputDiskonNilai.readOnly = false;
            }
            hitungHargaDiskon();
        });

        inputDiskonNilai.addEventListener('input', hitungHargaDiskon);
        hargaJualInput.addEventListener('input', hitungHargaDiskon);

        hitungHargaDiskon();
    });
</script>

@endsection