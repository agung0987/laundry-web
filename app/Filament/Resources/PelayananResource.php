<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PelayananResource\Pages;
use App\Models\PelangganPivotPelayanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class PelayananResource extends Resource
{
    protected static ?string $model = PelangganPivotPelayanan::class;
    protected static ?string $title = 'Pelayanan';

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static ?string $navigationGroup = 'Transaksi';
    protected static ?string $navigationLabel = 'Pelayanan';
    protected static ?string $label = 'Pelayanan';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            // ->query(PelangganPivotPelayanan::query()->where('status', null))
            ->columns([
                Tables\Columns\TextColumn::make('pelanggan.nama')
                    ->label('Pelanggan')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pembayaran.nama')
                    ->numeric()
                    ->label('Pembayaran')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_pesanan')
                    ->dateTime()
                    ->label('Tanggal Pesanan')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->numeric()
                    ->label('Biaya')
                    ->money('IDR', locale: 'id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('penginput')
                    ->label('Penginput')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_pesanan')
                    ->label('No Pesanan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->getStateUsing(fn($record) => $record->status ?? 'Belum')
                    ->label('Status')
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
            'index' => Pages\ListPelayanans::route('/'),
            'create' => Pages\CreatePelayanan::route('/create'),
            'edit' => Pages\EditPelayanan::route('/{record}/edit'),
        ];
    }
}
