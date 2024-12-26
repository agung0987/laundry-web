<?php

namespace App\Filament\Resources\TPengeluaranResource\Pages;

use App\Filament\Resources\TPengeluaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTPengeluarans extends ListRecords
{
    protected static string $resource = TPengeluaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
