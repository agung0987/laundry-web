<x-filament::page>
  <div class="w-full">
    <x-filament-panels::form wire:submit="saveForm">
      <div class="flex justify-between items-start mb-6">
        <div>
          <p><span class="font-bold">Tgl Pesan :</span> {{$this->record->tanggal_pesanan}}</p>
          <p><span class="font-bold">Pelanggan :</span> {{$this->record->pelanggan->nama}}</p>
        </div>
        <div>
          <p><span class="font-bold">Alamat :</span> {{$this->record->pelanggan->alamat}}</p>
          <p><span class="font-bold">HP :</span> 085730053239</p>
        </div>
      </div>
      <div class="flex justify-between items-center mb-6">
        <div>
          <p><span class="font-bold">No Pesanan :</span> {{$this->record->no_pesanan}}</p>
        </div>
        <div class="text-center">
          <p>Pembayaran saat ini : <span class="font-bold capitalize">{{$this->record->pembayaran->nama}}</span></p>
          <input wire:model="selectedpembayaran" type="hidden" name="selectedpembayaran"
            value="{{$this->record->pembayaran->id}}">
          <select id="layanan" wire:model="selectpembayaran" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            <option value="">Pilih Pembayaran</option>
            @foreach($pembayaran as $item)
            <option value="{{ $item->id }}">
              {{ $item->nama }}
            </option>
            @endforeach
          </select>
        </div>
      </div>
      <table class="w-full border-collapse border border-gray-300 mb-6">
        <thead>
          <tr class="bg-blue-600 text-white">
            <th class="border border-gray-300 px-4 py-2">No</th>
            <th class="border border-gray-300 px-4 py-2">Layanan</th>
            <th class="border border-gray-300 px-4 py-2">Lama Pengerjaan</th>
            <th class="border border-gray-300 px-4 py-2">Tarif (Rp.)</th>
            <th class="border border-gray-300 px-4 py-2">Jumlah</th>
            <th class="border border-gray-300 px-4 py-2">Sub Total (Rp.)</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($this->pelayanan as $pelayanan)
          <tr>
            <td class="border border-gray-300 px-4 py-2 text-center">1</td>
            <td class="border border-gray-300 px-4 py-2">{{$pelayanan->layanan->nama}}</td>
            <td class="border border-gray-300 px-4 py-2 text-center">{{$pelayanan->tarif->lama_pengerjaan}}</td>
            <td class="border border-gray-300 px-4 py-2 text-center">{{$pelayanan->tarif->tarif}}</td>
            <td class="border border-gray-300 px-4 py-2 text-center">{{$pelayanan->jumlah}}</td>
            <td class="border border-gray-300 px-4 py-2 text-center">{{$pelayanan->subtotal}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="text-right mb-6">
        <p class="text-lg font-bold">Total Biaya : <span class="text-red-500">Rp. {{$this->record->total}}</span></p>
      </div>
      <input type="text" value="{{$this->id}}" hidden wire:model="id">
      <div class="flex justify-center gap-4">
        <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600" type="submit">
          Update Status Menjadi Sudah Selesai
        </button>
      </div>
    </x-filament-panels::form>
  </div>
</x-filament::page>