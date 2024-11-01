<?php

namespace App\Filament\Resources\PengerjaanResource\Pages;

use App\Filament\Resources\PengerjaanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePengerjaan extends CreateRecord
{
    protected static string $resource = PengerjaanResource::class;

    protected static bool $canCreateAnother = false;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
