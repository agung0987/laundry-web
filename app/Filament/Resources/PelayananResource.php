<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PelayananResource\Pages;
use App\Filament\Resources\PelayananResource\RelationManagers;
use App\Models\Pelayanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PelayananResource extends Resource
{
    protected static ?string $model = Pelayanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static ?string $navigationGroup = 'Transaksi';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_pelanggan')
                    ->label('Pelanggan')
                    ->relationship('pelanggan', 'nama')
                    ->required(),
                Forms\Components\Select::make('id_pembayaran')
                    ->label('Pembayaran')
                    ->relationship('pembayaran', 'nama')
                    ->required(),
                Forms\Components\DateTimePicker::make('tanggal_pesanan')
                    ->required(),
                Forms\Components\TextInput::make('biaya')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('penginput')
                    ->default(Auth::check() ? Auth::user()->name : 'Guest')
                    ->disabled()
                    ->hidden()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('no_pesanan')
                    ->disabled()
                    ->hidden()
                    ->default(fn () => null), 
                Forms\Components\Toggle::make('status')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pelanggan.nama')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pembayaran.nama')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_pesanan')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('biaya')
                    ->numeric()
                    ->money('IDR', locale: 'id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('penginput')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_pesanan')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
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
