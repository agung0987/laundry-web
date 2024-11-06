<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Pelayanan;

class PelayananObserver
{
    public function creating(Pelayanan $pelayanan)
    {
        $date = Carbon::now()->format('Ymd');
        $countToday = Pelayanan::whereDate('created_at', Carbon::today())->count() + 1;
        $noPesanan = 'ORD-' . $date . '-' . str_pad($countToday, 4, '0', STR_PAD_LEFT);
        
        $pelayanan->no_pesanan = $noPesanan;

        $pelayanan->penginput = Auth::check() ? Auth::user()->name : 'Guest';
    }
}
