<?php
namespace App\Filament\Resources\PelayananResource\Pages;

use App\Filament\Resources\PelayananResource;
use App\Models\PelangganPivotPelayanan;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Pelayanan; // Pastikan kamu import model Pelayanan
use App\Models\Pembayaran;

class EditPelayanan extends EditRecord
{
    protected static string $resource = PelayananResource::class;
    protected static ?string $title = 'Pelayanan';
    protected static string $view = 'filament.resources.pelayanan-resource.pages.edit-pelayanan';
    public $pelayanan;
    public $pembayaran;
    public $selectpembayaran;
    public $selectedpembayaran;
    public $id;
    public function mount(string|int $record): void
    {
        $this->record = PelangganPivotPelayanan::findOrFail($record);
        $this->pembayaran = Pembayaran::all();
        $this->id = $this->record->id;
        $this->pelayanan = Pelayanan::where('id_pelanggan_pivot_pelayanan',$this->record->id)->get();
    }
    public function saveForm()
    {
        if($this->selectpembayaran == null){
            $data = PelangganPivotPelayanan::where('id', $this->id)->first();
            $data->status = 'Selesai';
            $data->save();
        }else{
            $data = PelangganPivotPelayanan::where('id', $this->id)->first();
            $data->status = 'Selesai';
            $data->id_pembayaran = $this->selectpembayaran;
            $data->save();
        }

        return redirect('/admin/pelayanans');
        // $this->record = PelangganPivotPelayanan::findOrFail($record);
        // $this->pelayanan = Pelayanan::where('id_pelanggan_pivot_pelayanan',$this->record->id)->get();
    }

}

