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
        'id_pelanggan_pivot_pelayanan',
        'id_pembayaran',
        'penginputan',
        'id_layanan',
        'id_tarif',
        'tanggal_pesanan',
        'no_pesanan',
        'jumlah',
        'subtotal',
        'total',
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
