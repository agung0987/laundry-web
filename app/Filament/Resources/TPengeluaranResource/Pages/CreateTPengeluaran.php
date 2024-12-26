<?php

namespace App\Filament\Resources\TPengeluaranResource\Pages;

use App\Filament\Resources\TPengeluaranResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTPengeluaran extends CreateRecord
{
    protected static string $resource = TPengeluaranResource::class;
    protected static bool $canCreateAnother = false;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
