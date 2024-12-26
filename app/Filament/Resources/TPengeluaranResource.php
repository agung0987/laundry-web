<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TPengeluaranResource\Pages;
use App\Filament\Resources\TPengeluaranResource\RelationManagers;
use App\Models\Pengeluaran;
use App\Models\t_pengeluaran;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TPengeluaranResource extends Resource
{
    protected static ?string $model = t_pengeluaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Pengeluaran';
    protected static ?string $navigationGroup = 'Transaksi';
    protected static ?string $label = 'Transaksi Pengeluaran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_pelanggan')
                    ->label('Pelanggan')
                    ->relationship('pelanggan', 'nama')
                    ->required(),
                Forms\Components\Select::make('id_pengeluaran')
                    ->label('Pengeluaran')
                    ->relationship('pengeluaran', 'nama')
                    ->required(),
                DatePicker::make('tanggal')
                    ->format('Y/m/d'),
                Forms\Components\TextInput::make('jumlah')
                    ->label('Jumlah')
                    ->required()
                    ->live()
                    ->afterStateUpdated(function (Set $set, Get $get) {
                        $id_pengeluaran = $get('id_pengeluaran');
                        $tarif = Pengeluaran::where('id', $id_pengeluaran)->value('tarif');
                        Self::total($get, $set, $tarif);
                    })
                    ->maxLength(255),
                TextInput::make('tarif')
                    ->label('Tarif')
                    ->numeric()
                    ->readOnly()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pelanggan.nama')
                    ->label('Pelanggan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pengeluaran.nama')
                    ->label('Pengeluaran')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Pengeluaran')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tarif')
                    ->label('Tarif')
                    ->searchable(),
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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListTPengeluarans::route('/'),
            'create' => Pages\CreateTPengeluaran::route('/create'),
            'edit' => Pages\EditTPengeluaran::route('/{record}/edit'),
        ];
    }

    public static function total(Get $get, Set $set, $tarif): void
    {
        $tarif = (float) ($tarif ?? 0);
        $jumlah = (int) ($get('jumlah') ?? 0);
        $set('tarif', $tarif * $jumlah);
    }
}
