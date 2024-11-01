<?php

namespace App\Filament\Resources\PengerjaanResource\Pages;

use App\Filament\Resources\PengerjaanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengerjaan extends EditRecord
{
    protected static string $resource = PengerjaanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
