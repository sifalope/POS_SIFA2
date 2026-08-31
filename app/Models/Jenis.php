<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jenis extends Model
{
    protected $table = 'jenis';

    protected $fillable = [
        'nama_jenis',
    ];

    public function produk(): HasMany
    {
        return $this->hasMany(Produk::class, 'jenis_id');
    }
}
