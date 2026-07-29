@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<style>
    body {
        background-color: #fff1f7;
    }

    /* Container Styling */
    .dashboard-container {
        max-width: 1200px;
        margin: 30px auto;
        padding: 0 20px;
    }

    /* Header Section */
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        background: white;
        padding: 20px 25px;
        border-radius: 20px;
        box-shadow: 0 4px 15px rgba(236,72,153,0.06);
        border: 1px solid #fce7f3;
    }

    .dashboard-header h1 {
        font-size: 22px;
        color: #be185d;
        font-weight: 800;
        margin: 0;
    }

    .date-badge {
        background: #fdf2f8;
        color: #ec4899;
        font-weight: 700;
        padding: 8px 16px;
        border-radius: 12px;
        font-size: 13px;
        border: 1px solid #fbcfe8;
    }

    /* Metrics Grid Section (4 Cards dalam 1 baris) */
    .metrics-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
        gap: 18px;
        margin-bottom: 30px;
    }

    .metric-card {
        background: white;
        border-radius: 20px;
        padding: 20px;
        border: 1px solid #fce7f3;
        box-shadow: 0 4px 12px rgba(236,72,153,0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .metric-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(236,72,153,0.12);
    }

    .metric-title {
        font-size: 12px;
        font-weight: 700;
        color: #9d174d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 10px;
    }

    .metric-value {
        font-size: 22px;
        font-weight: 800;
        color: #be185d;
        margin: 0;
    }

    .metric-sub {
        font-size: 11px;
        color: #94a3b8;
        margin-top: 5px;
    }

    /* Table Section Card */
    .section-card {
        background: white;
        border-radius: 20px;
        padding: 22px;
        border: 1px solid #fce7f3;
        box-shadow: 0 4px 15px rgba(236,72,153,0.05);
        margin-bottom: 25px;
    }

    .section-title {
        font-size: 16px;
        font-weight: 800;
        color: #be185d;
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .section-title::before {
        content: '';
        display: inline-block;
        width: 4px;
        height: 18px;
        background: #f472b6;
        border-radius: 4px;
    }

    /* Table Styling Modern */
    .custom-table {
        width: 100%;
        border-collapse: collapse;
    }

    .custom-table thead tr {
        background: #fdf2f8;
    }

    .custom-table th {
        color: #be185d;
        padding: 12px 15px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        border: none;
    }

    .custom-table th:first-child { border-radius: 12px 0 0 12px; }
    .custom-table th:last-child { border-radius: 0 12px 12px 0; }

    .custom-table td {
        padding: 12px 15px;
        color: #475569;
        font-size: 13px;
        border-bottom: 1px solid #fce7f3;
    }

    .custom-table tbody tr:last-child td {
        border-bottom: none;
    }

    .custom-table tbody tr:hover {
        background: #fff0f6;
    }

    /* Pagination Styling Override */
    .pagination-wrapper {
        margin-top: 12px;
    }
</style>

@include('layouts.navbar')

<div class="dashboard-container">

    <div class="dashboard-header">
        <div>
            <h1>Ringkasan Hari Ini</h1>
            <small class="text-muted" style="color: #94a3b8 !important;">Pantau performa penjualan dan status produk kamu.</small>
        </div>
        <div class="date-badge">
            {{ $TanggalHariIni->translatedFormat('l, d F Y') }}
        </div>
    </div>

    @can('viewAny', App\Models\User::class)
    <div class="metrics-grid">
        <div class="metric-card">
            <div class="metric-title">Total Penjualan</div>
            <div class="metric-value">Rp. {{ number_format($ringkasan['total_penjualan']) }}</div>
            <div class="metric-sub">Hasil transaksi hari ini</div>
        </div>

        <div class="metric-card">
            <div class="metric-title">Jumlah Transaksi</div>
            <div class="metric-value">{{ number_format($ringkasan['total_transaksi']) }} <span style="font-size: 14px; font-weight: 600; color: #94a3b8;">trx</span></div>
            <div class="metric-sub">Nota transaksi berhasil</div>
        </div>

        <div class="metric-card">
            <div class="metric-title">Pembayaran Tunai</div>
            <div class="metric-value">Rp. {{ number_format($ringkasan['total_cash']) }}</div>
            <div class="metric-sub">Total tunai diterima</div>
        </div>

        <div class="metric-card">
            <div class="metric-title">Pembayaran Non-Tunai</div>
            <div class="metric-value">Rp. {{ number_format($ringkasan['total_non_tunai']) }}</div>
            <div class="metric-sub">Transfer / QRIS / Card</div>
        </div>
    </div>
    @endcan

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="section-card">
                <div class="section-title">Daftar Produk Stok Rendah</div>
                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Produk</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produkStokRendah as $index => $produk)
                            <tr>
                                <td><strong>{{ $produkStokRendah->firstItem() + $index }}</strong></td>
                                <td>{{ $produk->nama }}</td>
                                <td><span style="color: #eab308; font-weight: 700;">{{ $produk->stok }} unit</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-3">
                                    Seluruh produk berada dalam kondisi stok aman.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="pagination-wrapper">
                    {{ $produkStokRendah->links() }}
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="section-card">
                <div class="section-title">Produk Habis Stok</div>
                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Produk</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produkStokHabis as $index => $produk)
                            <tr>
                                <td><strong>{{ $produkStokHabis->firstItem() + $index }}</strong></td>
                                <td>{{ $produk->nama }}</td>
                                <td><span style="color: #ef4444; font-weight: 700;">{{ $produk->stok }} unit</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-3">
                                    Seluruh produk berada dalam kondisi stok aman.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="pagination-wrapper">
                    {{ $produkStokHabis->links() }}
                </div>
            </div>
        </div>
    </div>

    <div class="section-card">
        <div class="section-title">Best Seller Products</div>
        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Sisa Stok</th>
                        <th>Unit Terjual</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produkTerlaris as $produk)
                    <tr>
                        <td><strong>{{ $produk->nama }}</strong></td>
                        <td>{{ $produk->stok }}</td>
                        <td><span style="color: #be185d; font-weight: 700;">{{ $produk->total_terjual }} terjual</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-3">
                            Belum ada data transaksi produk terlaris.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection