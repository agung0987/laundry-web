<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengerjaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_layanan',
        'pengerjaan',
        'tarif',
        // 'status',
    ];

    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class,'id_layanan','id');
    }
}
