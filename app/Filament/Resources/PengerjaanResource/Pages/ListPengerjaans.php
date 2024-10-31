<?php

namespace App\Filament\Resources\PengerjaanResource\Pages;

use App\Filament\Resources\PengerjaanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengerjaans extends ListRecords
{
    protected static string $resource = PengerjaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
