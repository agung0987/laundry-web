<?php

namespace App\Filament\Resources\PelayananResource\Pages;

use App\Filament\Resources\PelayananResource;
use Filament\Resources\Pages\Page;

class FormPelayanan extends Page
{
    protected static string $resource = PelayananResource::class;

    protected static string $view = 'filament.resources.pelayanan-resource.pages.form-pelayanan';
}
