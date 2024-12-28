<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelayanan extends Model
{
    use HasFactory;

    protected $table = 'pelayanans';

    protected $fillable = [
        'id_pelanggan_pivot_pelayanan',
        'id_layanan',
        'id_tarif',
        'jumlah',
        'subtotal',
    ];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan', 'id');
    }
    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'id_tarif', 'id');
    }
}
