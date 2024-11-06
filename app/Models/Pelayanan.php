<?php

namespace App\Models;

use App\Observers\PelayananObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelayanan extends Model
{
    use HasFactory;

    protected $table = 'pelayanans';

    protected $fillable = [
        'id_pelanggan',
        'id_pembayaran',
        'tanggal_pesanan',
        'biaya',
        'penginput',
        'no_pesanan',
        'status',
    ];

    protected static function booted()
    {
        static::observe(PelayananObserver::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id');
    }
    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'id_pembayaran', 'id');
    }
}
