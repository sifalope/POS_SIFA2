<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'user_id',
        'jenis_id', 
        'foto',
        'nama',
        'jenis',
        'harga_beli',
        'harga_jual',
        'stok',
        'diskon',
        'is_bestseller' 
    ];

    
    protected $casts = [
        'is_bestseller' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jenisRelasi()
    {
        return $this->belongsTo(Jenis::class, 'jenis_id');
    }

    public function itemPenjualan()
    {
        return $this->hasMany(ItemPenjualan::class, 'produk_id');
    }
}