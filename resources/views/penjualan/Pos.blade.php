@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

@include('layouts.navbar')

<div class="container-fluid py-4 px-3 px-md-4 min-vh-100" style="background-color: #fdf2f8;">

    {{-- Alert Error jika ada --}}
    @if(session('errors'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4 rounded-3" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('errors') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Header Halaman --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-1" style="color: #831843;">
                Tambah Penjualan
            </h4>
        </div>
    </div>

    <div class="row g-4">

        {{-- =================== SISI KIRI: KATALOG PRODUK =================== --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-3" style="background-color: #ffffff; border: 1px solid #fbcfe8 !important;">
                
                {{-- Search Bar Katalog --}}
                <div class="mb-3">
                    <form method="GET" action="{{ isset($sale) ? route('penjualan.edit', $sale->id) : route('penjualan.create') }}" id="searchForm">
                        @if(isset($sale))
                            <input type="hidden" name="penjualan_id" value="{{ $sale->id }}">
                        @endif
                        <input type="text"
                               id="inputSearchProduk"
                               name="search"
                               value="{{ request('search') }}"
                               class="form-control rounded-4 py-2 px-3 border-1 shadow-none"
                               style="background-color: #fff5f7; border-color: #fbcfe8; color: #831843;"
                               placeholder="Cari produk..."
                               autocomplete="off"
                               autofocus>
                    </form>
                </div>
                
                {{-- Daftar Katalog Produk --}}
                <div style="max-height: 65vh; overflow-y: auto;">
                    <div class="d-flex flex-column gap-3">
                        @forelse($products as $product)
                            <form method="POST" action="{{ route('itempenjualan.store') }}" class="m-0">
                                @csrf
                                @if(isset($sale))
                                    <input type="hidden" name="penjualan_id" value="{{ $sale->id }}">
                                @endif
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <div class="d-flex align-items-center gap-2">
                                    {{-- Info Produk --}}
                                    <div class="card flex-grow-1 border-0 rounded-4 p-2 shadow-sm" style="background-color: #fff5f7; border: 1px solid #fbcfe8 !important;">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="rounded-3 overflow-hidden flex-shrink-0" style="width: 50px; height: 50px; background-color: #fff;">
                                                @if(!empty($product->foto))
                                                    <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama }}" class="w-100 h-100 object-fit-cover">
                                                @elseif(!empty($product->image))
                                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->nama }}" class="w-100 h-100 object-fit-cover">
                                                @else
                                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                                        <i class="bi bi-image fs-4" style="color: #ec4899;"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex-grow-1 min-w-0">
                                                <h6 class="fw-bold mb-0 text-truncate" style="color: #831843; font-size: 0.9rem;">
                                                    {{ $product->nama }}
                                                </h6>
                                                <small class="fw-bold" style="color: #ec4899;">
                                                    Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Qty Input --}}
                                    <div style="width: 90px;">
                                        <input type="number" name="quantity" value="1" min="1" 
                                               class="form-control text-center rounded-4 fw-bold shadow-none" 
                                               style="background-color: #fff5f7; border: 1px solid #fbcfe8; color: #831843; height: 48px;">
                                    </div>

                                    {{-- Tombol Tambah --}}
                                    <button type="submit" class="btn text-white rounded-4 fw-bold px-3 d-flex align-items-center justify-content-center shadow-sm" 
                                            style="background-color: #ec4899; height: 48px; border: none;">
                                        <i class="bi bi-plus-lg fs-5"></i>
                                    </button>
                                </div>
                            </form>
                        @empty
                            <div class="text-center py-5">
                                <p class="text-muted small mb-0">Produk tidak ditemukan.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>

        {{-- =================== SISI KANAN: KERANJANG BELANJA =================== --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 p-3" style="background-color: #ffffff; border: 1px solid #fbcfe8 !important;">
                
                {{-- Table Produk Keranjang --}}
                <div class="table-responsive mb-3" style="max-height: 35vh; overflow-y: auto;">
                    <table class="table table-borderless align-middle mb-0">
                        <thead>
                            <tr style="color: #831843;" class="small fw-bold border-bottom">
                                <th>Produk</th>
                                <th>Harga</th>
                                <th class="text-center">Qty</th>
                                <th>Subtotal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($sale) && $sale->itemPenjualan && $sale->itemPenjualan->count() > 0)
                                @foreach($sale->itemPenjualan as $item)
                                <tr>
                                    <td class="fw-semibold text-truncate" style="color: #831843; max-width: 120px;" title="{{ $item->produk->nama }}">
                                        {{ $item->produk->nama }}
                                    </td>
                                    <td class="text-nowrap small" style="color: #831843;">
                                        Rp {{ number_format($item->produk->harga_jual, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                            @csrf @method('PUT')
                                            <input type="number" name="quantity"
                                                   value="{{ $item->kuantitas }}"
                                                   min="1"
                                                   class="form-control form-control-sm text-center fw-bold rounded-3 shadow-none"
                                                   style="border-color: #fbcfe8; color: #831843; background-color: #fff5f7;"
                                                   onchange="this.form.submit()">
                                        </form>
                                    </td>
                                    <td class="fw-bold text-nowrap small" style="color: #831843;">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        @can('delete', $item)
                                        <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm rounded-circle border-0" style="color: #ec4899;">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted small">
                                        Keranjang kosong
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="pt-2 border-top border-dashed">
                    {{-- Total Pembayaran --}}
                    <div class="mb-3">
                        <h5 class="fw-bold" style="color: #831843;">
                            Total: <span id="totalPembayaranValue" data-total="{{ isset($sale) ? $sale->total_pembayaran : 0 }}">Rp {{ isset($sale) ? number_format($sale->total_pembayaran, 0, ',', '.') : '0' }}</span>
                        </h5>
                    </div>

                    {{-- Form Pembayaran & Checkout --}}
                    @if(isset($sale) && $sale->itemPenjualan && $sale->itemPenjualan->count() > 0)
                        <form method="POST" action="{{ route('penjualan.update', $sale->id) }}" id="formCheckout" onsubmit="return confirm('Yakin ingin checkout transaksi ini?')">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <select name="metode_pembayaran" id="metodePembayaran" class="form-select rounded-4 py-2 shadow-none" style="border-color: #fbcfe8; color: #831843; background-color: #fff5f7;" required>
                                    <option value="" disabled selected>Pilih Pembayaran</option>
                                    <option value="CASH">Cash / Tunai</option>
                                    <option value="QRIS">QRIS</option>
                                </select>
                            </div>

                            {{-- Bagian Cash --}}
                            <div id="cashSection" class="mb-3 p-3 rounded-4 shadow-sm d-none" style="background-color: #fff5f7; border: 1px solid #fbcfe8;">
                                <div class="mb-2">
                                    <label class="form-label small fw-bold" style="color: #831843;">Uang yang Dikasih (Cash)</label>
                                    <input type="number" name="uang_diberikan" id="uangDiberikan" class="form-control rounded-pill shadow-none" style="border-color: #fbcfe8; color: #831843;" placeholder="Masukkan jumlah uang..">
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <span class="small fw-bold text-muted">Uang Kembalian:</span>
                                    <span class="fw-bold small text-success" id="uangKembalian">Rp 0</span>
                                </div>
                            </div>

                            {{-- Bagian QRIS --}}
                            <div id="qrisSection" class="mb-3 p-3 rounded-4 shadow-sm text-center d-none" style="background-color: #fff5f7; border: 1px solid #fbcfe8;">
                                <span class="fw-bold d-block mb-2" style="color: #831843;">Sifa Beauty</span>
                                <div class="bg-white p-2 rounded-3 d-inline-block shadow-sm">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=QRIS_PAYMENT" alt="QRIS" class="img-fluid rounded" style="max-width: 140px; height: auto;">
                                </div>
                            </div>

                            {{-- Tombol Checkout --}}
                            <div class="d-grid mb-2">
                                <button type="submit" class="btn text-white fw-bold py-2 rounded-4 shadow-sm" style="background-color: #ec4899; border: none;">
                                    Checkout
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="mb-3">
                            <select class="form-select rounded-4 py-2 shadow-none" style="border-color: #fbcfe8; color: #831843; background-color: #fff5f7;" disabled>
                                <option>Pilih Pembayaran</option>
                            </select>
                        </div>
                        <div class="d-grid mb-2">
                            <button type="button" class="btn text-white fw-bold py-2 rounded-4 shadow-sm" style="background-color: #ec4899; border: none;" disabled>
                                Checkout
                            </button>
                        </div>
                    @endif

                    {{-- Tombol Batal Transaksi --}}
                    @if(isset($sale))
                        <div class="d-grid">
                            <button type="button" 
                                    class="btn rounded-4 py-2 fw-bold shadow-sm"
                                    style="background-color: #fff5f7; color: #be185d; border: 1px solid #fbcfe8;"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalBatalTransaksi">
                                Batal Transaksi
                            </button>
                        </div>

                        {{-- Modal Konfirmasi Batal --}}
                        <div class="modal fade" id="modalBatalTransaksi" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content border-0 shadow-lg rounded-4" style="border: 1px solid #fbcfe8 !important;">
                                    <div class="modal-body text-center p-4">
                                        <div class="mb-3" style="color: #ec4899;">
                                            <i class="bi bi-exclamation-circle fs-1"></i>
                                        </div>
                                        <h6 class="fw-bold mb-2" style="color: #831843;">Batalkan Transaksi?</h6>
                                        <p class="text-muted small mb-4">Semua item di keranjang akan dihapus dan transaksi dibatalkan.</p>
                                        
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn w-50 btn-sm fw-semibold rounded-pill border-0" style="background-color: #fff5f7; color: #831843;" data-bs-dismiss="modal">Tidak</button>
                                            <form action="{{ route('penjualan.destroy', $sale->id) }}" method="POST" class="w-50">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn w-100 btn-sm fw-semibold rounded-pill text-white border-0" style="background-color: #ec4899;">Ya, Batalkan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="d-grid">
                            <button type="button" class="btn rounded-4 py-2 fw-bold shadow-sm" style="background-color: #fff5f7; color: #be185d; border: 1px solid #fbcfe8;" disabled>
                                Batal Transaksi
                            </button>
                        </div>
                    @endif

                </div>

            </div>
        </div>

    </div>

    {{-- Tombol Kembali --}}
    <div class="mt-4">
        <a href="{{ route('penjualan.index') }}" 
           class="btn fw-semibold px-4 py-2 rounded-4 shadow-sm border-0 d-inline-flex align-items-center gap-2"
           style="background-color: #fbcfe8; color: #831843;">
            &larr; Kembali
        </a>
    </div>

</div>

{{-- Skrip Interaksi Dinamis Metode Pembayaran --}}
<script>
    let timer;
    const inputSearch = document.getElementById('inputSearchProduk');
    const searchForm = document.getElementById('searchForm');

    inputSearch?.addEventListener('keyup', function() {
        clearTimeout(timer);
        timer = setTimeout(function() {
            searchForm.submit();
        }, 600);
    });

    window.onload = function() {
        if (inputSearch) {
            inputSearch.focus();
            inputSearch.setSelectionRange(inputSearch.value.length, inputSearch.value.length);
        }
    };

    document.getElementById('metodePembayaran')?.addEventListener('change', function() {
        const cashSection = document.getElementById('cashSection');
        const qrisSection = document.getElementById('qrisSection');
        const inputUang = document.getElementById('uangDiberikan');

        if (this.value === 'CASH') {
            cashSection?.classList.remove('d-none');
            qrisSection?.classList.add('d-none');
            inputUang?.setAttribute('required', 'required');
        } else if (this.value === 'QRIS') {
            cashSection?.classList.add('d-none');
            qrisSection?.classList.remove('d-none');
            inputUang?.removeAttribute('required');
            if(inputUang) inputUang.value = '';
        }
    });

    document.getElementById('uangDiberikan')?.addEventListener('input', function() {
        const total = parseFloat(document.getElementById('totalPembayaranValue').getAttribute('data-total')) || 0;
        const bayar = parseFloat(this.value) || 0;
        const kembalian = bayar - total;

        const kembalianElem = document.getElementById('uangKembalian');
        if (kembalianElem) {
            if (kembalian >= 0) {
                kembalianElem.textContent = 'Rp ' + kembalian.toLocaleString('id-ID');
                kembalianElem.classList.remove('text-danger');
                kembalianElem.classList.add('text-success');
            } else {
                kembalianElem.textContent = 'Uang kurang (Rp ' + Math.abs(kembalian).toLocaleString('id-ID') + ')';
                kembalianElem.classList.remove('text-success');
                kembalianElem.classList.add('text-danger');
            }
        }
    });
</script>
@endsection