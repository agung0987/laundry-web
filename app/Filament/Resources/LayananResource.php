<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Tarif;
use App\Models\Layanan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Actions\ActionGroup;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\LayananResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LayananResource\RelationManagers;
use Filament\Notifications\Notification;

class LayananResource extends Resource
{
    protected static ?string $model = Layanan::class;

    protected static ?string $navigationGroup = 'Master';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('id_kategori')
                ->label('Kategori')
                ->relationship('kategori', 'nama')
                ->required(),
            Forms\Components\TextInput::make('nama')
                ->label('Nama Layanan')
                ->required()
                ->maxLength(255),
            // Forms\Components\Toggle::make('status')
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('kategori.nama')
                ->label('Kategori')
                ->numeric()
                ->sortable(),
            Tables\Columns\TextColumn::make('nama')
                ->searchable(),
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
            Action::make('tarif')
                ->label('Tarif')
                ->icon('heroicon-o-currency-dollar')
                ->form([
                    Forms\Components\Repeater::make('tarifs')
                        ->label('Tarif')
                        ->schema([
                            Forms\Components\TextInput::make('lama_pengerjaan')
                                ->label('Lama Pengerjaan')
                                ->required(),
                            Forms\Components\TextInput::make('tarif')
                                ->label('Tarif')
                                ->numeric()
                                ->required(),
                            // Forms\Components\Toggle::make('status')
                            //     ->label('Aktif')
                            //     ->required(),
                        ])
                        ->defaultItems(1)
                        ->afterStateHydrated(function ($state, $set, $record) {
                            // Ambil tarif yang sudah ada berdasarkan layanan yang dipilih
                            $existingTarifs = Tarif::where('id_layanan', $record->id)->get();
                            $set('tarifs', $existingTarifs->toArray());
                        }),
                ])
                ->action(function (array $data, Layanan $record) {
                    foreach ($data['tarifs'] as $tarifData) {
                        Tarif::updateOrCreate(
                            [
                                'id_layanan' => $record->id,
                                'lama_pengerjaan' => $tarifData['lama_pengerjaan'],
                            ],
                            [
                                'tarif' => $tarifData['tarif'],
                                // 'status' => $tarifData['status'],
                            ]
                        );
                    }
        
                    Notification::make()
                        ->title('Tarif berhasil disimpan')
                        ->success()
                        ->send();
                }),
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
            'index' => Pages\ListLayanans::route('/'),
            'create' => Pages\CreateLayanan::route('/create'),
            'edit' => Pages\EditLayanan::route('/{record}/edit'),
        ];
    }
}
