<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Layanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_kategori',
        'nama',
        'harga',
        // 'status',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class,'id_kategori','id');
    }
    
    public function tarif()
    {
        return $this->hasMany(Tarif::class,'id','id');
    }

}
