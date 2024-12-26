<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class t_pengeluaran extends Model
{
    protected $table = "t_pengeluarans";
    protected $fillable = ['id_pengeluaran','id_pelanggan','tanggal','jumlah','tarif'];

    public function pengeluaran(): BelongsTo
    {
        return $this->belongsTo(Pengeluaran::class,'id_pengeluaran','id');
    }
    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class,'id_pelanggan','id');
    }
}
