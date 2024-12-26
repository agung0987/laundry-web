<?php

namespace App\Filament\Resources\PelayananResource\Pages;

use App\Filament\Resources\PelayananResource;
use App\Models\Kategori;
use App\Models\Layanan;
use App\Models\Tarif;
use App\Models\PelangganPivotPelayanan;
use App\Models\Pelayanan;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\CreateRecord;

class CreatePelayanan extends CreateRecord
{
    protected static bool $canCreateAnother = false;
    protected static string $resource = PelayananResource::class;
    protected static string $view = 'filament.resources.pelayanan-resource.pages.form-pelayanan';

    public function form(Form $form): Form
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
                Forms\Components\TextInput::make('penginput')
                    ->default(Auth::check() ? Auth::user()->name : 'Guest')
                    ->disabled()
                    ->hidden()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('no_pesanan')
                    ->disabled()
                    ->hidden()
                    ->default(fn() => null),

                TableRepeater::make('Table')
                    ->headers([
                        Header::make('Layanan')->width('18%'),
                        Header::make('Lama Pengerjaan'),
                        Header::make('Tarif'),
                        Header::make('Jumlah'),
                        Header::make('Subtotal'),
                    ])
                    ->schema([
                        Select::make('Layanan')
                            ->searchable()
                            ->placeholder('Pilih Layanan')
                            ->options(function () {
                                return Kategori::with('layanan')->get()->mapWithKeys(function ($category) {
                                    return [$category->nama => $category->layanan->pluck('nama', 'id')];
                                });
                            })
                            ->live()
                            ->afterStateUpdated(function (Set $set) {
                                $set('Lama Pengerjaan', null);
                                $set('Tarif', null);
                                $set('Subtotal', null);
                            }),

                        Select::make('Lama Pengerjaan')
                            ->searchable()
                            ->placeholder('Pilih Lama Pengerjaan')
                            ->options(function (Get $get) {
                                $layananId = $get('Layanan');
                                return $layananId ? Tarif::where('id_layanan', $layananId)->pluck('lama_pengerjaan', 'id') : [];
                            })
                            ->live()
                            ->afterStateUpdated(function (Set $set, Get $get) {
                                $layananId = $get('Layanan');
                                $lamaPengerjaanId = $get('Lama Pengerjaan');
                                if ($layananId && $lamaPengerjaanId) {
                                    $tarif = Tarif::where('id_layanan', $layananId)
                                        ->where('id', $lamaPengerjaanId)
                                        ->value('tarif');

                                    $set('Tarif', $tarif ?: null);
                                    Self::total($get, $set);
                                } else {
                                    $set('Tarif', null);
                                    $set('Subtotal', null);
                                }
                            }),

                        TextInput::make('Tarif')
                            ->disabled()
                            ->numeric()
                            ->dehydrated(false),

                        TextInput::make('Jumlah')
                            ->required()
                            ->numeric()
                            ->live()
                            ->afterStateUpdated(function (Set $set, Get $get) {
                                Self::total($get, $set);
                            }),

                        TextInput::make('Subtotal')
                            ->required()
                            ->numeric()
                            ->readOnly(),
                    ])
                    ->reactive() // Pastikan data di TableRepeater bersifat reaktif
                    ->afterStateUpdated(function (Set $set, Get $get) {
                        // Panggil metode total setiap kali data berubah
                        Self::total($get, $set);
                    })
                    ->columnSpan('full'),
                Grid::make(3)
                    ->schema([
                        TextInput::make('total')
                            ->columnSpan('full')
                            ->readOnly(),
                        // ...
                    ])
            ]);
    }

    public static function total(Get $get, Set $set): void
    {
        $rows = $get('Table') ?? [];
        $grandTotal = 0;

        $jumlah1 = (float) ($get('Jumlah') ?? 0);
        $tarif2 = (float) ($get('Tarif') ?? 0);

        $set('Subtotal', $tarif2 * $jumlah1);

        foreach ($rows as $row) {
            $jumlah = (float) ($row['Jumlah'] ?? 0);
            $tarif = (float) ($row['Tarif'] ?? 0);
            $subtotal = $tarif * $jumlah;

            $grandTotal += $subtotal; // Tambahkan setiap subtotal ke total keseluruhan
        }

        $set('total', $grandTotal); // Set nilai total ke kolom "total"
    }

    public function save()
    {
        $data = $this->form->getState();
        $no_pesanan_random = 'LUD' . '-' . rand(10, 10000);
        $pelangganPivotPelayanan = new PelangganPivotPelayanan();
        $pelangganPivotPelayanan->id_pelanggan = $data['id_pelanggan'];
        $pelangganPivotPelayanan->save();

        for ($i = 0; $i < count($data['Table']); $i++) {
            $dataSubmit = new Pelayanan();
            $dataSubmit->pelanggan_pivot_pelayanan = $pelangganPivotPelayanan->id;
            $dataSubmit->id_pembayaran = $data['id_pembayaran'];
            $dataSubmit->penginput = Auth::user()->name;
            $dataSubmit->id_layanan = $data['Table'][$i]['Layanan'];
            $dataSubmit->id_tarif = $data['Table'][$i]['Lama Pengerjaan'];
            $dataSubmit->tanggal_pesanan = $data['tanggal_pesanan'];
            $dataSubmit->no_pesanan = $no_pesanan_random;
            $dataSubmit->jumlah = $data['Table'][$i]['Jumlah'];
            $dataSubmit->subtotal = $data['Table'][$i]['Subtotal'];
            $dataSubmit->total = $data['total'];
            $dataSubmit->save();
        }

        return redirect()->route('filament.resources.pelayanans.index');
    }
}
