<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PelangganPivotPelayanan extends Model
{
    protected $table = 'pelanggan_pivot_pelayanan';
    protected $fillable = [
        'pelanggan_id',
        'status',
    ];
}
