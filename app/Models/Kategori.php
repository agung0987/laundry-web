<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategoris';
    protected $guarded = ['id'];
    protected $fillable =[
        'nama',
        'satuan',
    ];

    public function layanan(): HasMany
    {
        return $this->hasMany(Layanan::class,'id','id');
    }
}
