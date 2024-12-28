<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PelangganPivotPelayanan extends Model
{
    protected $table = 'pelanggan_pivot_pelayanans';
    protected $fillable = [
        'id_pelanggan',
        'status',
        'id_pembayaran',
        'total',
        'tanggal_pesanan',
        'penginput',
        'no_pesanan',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id');
    }
    public function pelayanan()
    {
        return $this->hasMany(Pelayanan::class, 'id', 'id');
    }
    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'id_pembayaran', 'id');
    }
}
