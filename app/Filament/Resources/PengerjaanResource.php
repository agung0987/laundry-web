<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengerjaanResource\Pages;
use App\Filament\Resources\PengerjaanResource\RelationManagers;
use App\Models\Pengerjaan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengerjaanResource extends Resource
{
    protected static ?string $model = Pengerjaan::class;

    protected static ?string $navigationGroup = 'Master';

    protected static ?int $navigationSort = 1;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('id_layanan')
                ->label('Layanan')
                ->relationship('layanan', 'nama')
                ->required(),
            Forms\Components\TextInput::make('pengerjaan')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('tarif')
                ->required()
                ->numeric(),
                // Forms\Components\Toggle::make('status')
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('layanan.nama')
                ->label('Layanan')
                ->numeric()
                ->sortable(),
            Tables\Columns\TextColumn::make('pengerjaan')
                ->searchable(),
            Tables\Columns\TextColumn::make('tarif')
                ->numeric()
                ->sortable(),
                // Tables\Columns\IconColumn::make('status')
                // ->boolean(),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
        // ->bulkActions([
        //     Tables\Actions\BulkActionGroup::make([
        //         Tables\Actions\DeleteBulkAction::make(),
        //     ]),
        // ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengerjaans::route('/'),
            'create' => Pages\CreatePengerjaan::route('/create'),
            'edit' => Pages\EditPengerjaan::route('/{record}/edit'),
        ];
    }
}
