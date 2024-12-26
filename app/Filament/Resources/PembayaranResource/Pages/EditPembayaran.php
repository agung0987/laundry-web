<?php

namespace App\Filament\Resources\PembayaranResource\Pages;

use App\Filament\Resources\PembayaranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPembayaran extends EditRecord
{
    protected static string $resource = PembayaranResource::class;
    protected static ?string $title = 'Ubah Pembayaran';


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
