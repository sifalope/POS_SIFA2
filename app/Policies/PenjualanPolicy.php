<?php

namespace App\Policies;

use App\Models\Penjualan;
use App\Models\User;

class PenjualanPolicy
{
    /**
     * Determine whether the user can delete the penjualan.
     */
    public function delete(User $user, Penjualan $sale)
    {
        // Contoh: hanya admin atau kasir yang membuat penjualan bisa hapus
        return $user->role->name === 'admin' || $user->id === $sale->user_id;
    }
}
