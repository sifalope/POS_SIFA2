<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Penjualan;
use App\Models\ItemPenjualan;

class PenjualanSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            Penjualan::factory()
                ->count(50)
                ->create()
                ->each(function ($penjualan) {

                    $items = ItemPenjualan::factory()
                        ->count(rand(1, 5))
                        ->make([
                            'penjualan_id' => $penjualan->id,
                        ]);

                    $total = $items->sum('subtotal');

                    $penjualan->itemPenjualan()->saveMany($items);

                    $penjualan->update([
                        'total_pembayaran' => $total,
                    ]);
                });

        });
    }
}
