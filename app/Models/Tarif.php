<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tarif extends Model
{
    use HasFactory;
    protected $table = 'tarifs';

    protected $fillable = [
        'id_layanan',
        'lama_pengerjaan',
        'tarif',
        // 'status',
    ];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan', 'id');
    }
}
