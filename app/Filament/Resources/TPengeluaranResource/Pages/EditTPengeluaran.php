<?php

namespace App\Filament\Resources\TPengeluaranResource\Pages;

use App\Filament\Resources\TPengeluaranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTPengeluaran extends EditRecord
{
    protected static string $resource = TPengeluaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
