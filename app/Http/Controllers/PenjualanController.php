<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\ItemPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $user = Auth::user();
        $keyword = $request->input('search');

        $sales = Penjualan::with('user') // Eager loading relasi user
            ->when($user->role && $user->role->name === 'kasir', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('penjualan.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(SearchRequest $request)
    {
        $sale = Penjualan::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'status'  => 'OPEN'
            ],
            [
                'total_pembayaran'  => 0,
                'metode_pembayaran' => 'CASH'
            ]
        );

        // Recalculate total pembayaran
        $sale->update([
            'total_pembayaran' => $sale->itemPenjualan()->sum('subtotal') ?? 0
        ]);

        $keyword = $request->input('search');

        $products = Produk::when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })
            ->orderBy('nama')
            ->get();

        $mode = 'create';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjualan $penjualan)
    {
        $sale = $penjualan;
        
        // Eager load itemPenjualan beserta data produk terkait
        $sale->load('itemPenjualan.produk');
        $products = Produk::orderBy('nama')->get();
        $mode = 'view';

        return view('penjualan.detail', compact('sale', 'products', 'mode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {
        $sale = $penjualan;

        abort_if($sale->status === 'COMPLETED', 403, 'Transaksi yang sudah selesai tidak dapat diubah.');

        $sale->load('itemPenjualan.produk');
        $products = Produk::orderBy('nama')->get();
        $mode = 'edit';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Update the specified resource in storage (PROSES CHECKOUT).
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'payment_method' => 'required|in:CASH,QRIS'
        ], [
            'payment_method.required' => 'Pilih metode pembayaran (CASH/QRIS) terlebih dahulu!',
            'payment_method.in'       => 'Metode pembayaran tidak valid.'
        ]);

        if ($penjualan->status !== 'OPEN') {
            return back()->with('error', 'Transaksi sudah diproses.');
        }

        if ($penjualan->itemPenjualan()->count() === 0) {
            return back()->with('error', 'Keranjang masih kosong.');
        }

        // =========================================================
        // 1. TAMBAHAN VALIDASI CEK STOK SEBELUM DISIMPAN
        // =========================================================
        foreach ($penjualan->itemPenjualan as $item) {
            $produk = $item->produk;
            
            if ($produk) {
                // Cek nama kolom kuantitas/qty
                $qtyDibeli = $item->kuantitas ?? $item->qty ?? 1;

                if ($qtyDibeli > $produk->stok) {
                    $namaProduk = $produk->nama ?? $produk->name ?? 'Produk';
                    return back()->with('error', "Stok untuk produk '{$namaProduk}' tidak mencukupi! (Sisa stok: {$produk->stok}, Dibeli: {$qtyDibeli})");
                }
            }
        }

        // =========================================================
        // 2. PROSES TRANSAKSI & KURANGI STOK
        // =========================================================
        DB::transaction(function () use ($penjualan, $request) {
            
            // Kurangi stok masing-masing produk
            foreach ($penjualan->itemPenjualan as $item) {
                if ($item->produk) {
                    $qtyDibeli = $item->kuantitas ?? $item->qty ?? 1;
                    $item->produk()->decrement('stok', $qtyDibeli);
                }
            }

            $total = $penjualan->itemPenjualan()->sum('subtotal');

            $penjualan->update([
                'metode_pembayaran' => $request->payment_method,
                'total_pembayaran'  => $total,
                'status'            => 'COMPLETED'
            ]);
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil diselesaikan.');
    }

    /**
     * Hapus item tertentu dari keranjang dan rekalkulasi total pembayaran.
     */
    public function destroyItem(ItemPenjualan $item)
    {
        $penjualan = $item->penjualan;

        if ($penjualan->status !== 'OPEN') {
            return back()->with('error', 'Transaksi sudah selesai.');
        }

        DB::transaction(function () use ($item, $penjualan) {
            // Note: Stok tidak perlu di-increment di sini jika saat tambah item ke keranjang stok belum dipotong di DB
            $item->delete();

            $newTotal = $penjualan->itemPenjualan()->sum('subtotal') ?? 0;

            $penjualan->update([
                'total_pembayaran' => $newTotal
            ]);
        });

        return back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjualan $penjualan)
    {
        if ($penjualan->status !== 'OPEN') {
            return redirect()
                ->route('penjualan.index')
                ->with('error', 'Transaksi yang sudah selesai tidak dapat dibatalkan.');
        }

        DB::transaction(function () use ($penjualan) {
            $penjualan->itemPenjualan()->delete();
            $penjualan->delete();
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil dibatalkan.');
    }
}