<x-filament-panels::page>
  <div class="max-w-7xl mx-auto mt-8 grid grid-cols-1 gap-6 px-4 w-full">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

      <div class="bg-green-500 text-white shadow rounded-lg p-6">
        <h3 class="text-lg font-semibold">Penerimaan Hari Ini</h3>
        <div class="mt-2">
          <p class="text-xl font-bold">Rp. {{ number_format($this->penerimaanCount ?? 0, 0, ',', '.') }}</p>
          <p class="mt-2 text-sm">dari {{$this->penerimaanOrderCount}} orderan</p>
        </div>
      </div>


      <div class="text-white shadow rounded-lg p-6" style="background-color: #f0560e;">
        <h3 class="text-lg font-semibold">Pengeluaran Hari Ini</h3>
        <div class="mt-2">
          <p class="text-xl font-bold">Rp. {{ number_format($this->pengeluaranCount ?? 0, 0, ',', '.') }}</p>
          <p class="mt-2 text-sm">dari {{$this->pengeluaranOrderCount}} transaksi</p>
        </div>
      </div>

      <div class="text-white shadow rounded-lg p-6" style="background-color: #49caf5;">
        <h3 class="text-lg font-semibold">Pendapatan Hari Ini</h3>
        <div class="mt-2">
          <p class="text-xl font-bold">Rp.{{number_format($this->pendapatanHariIni ?? 0, 0, ',', '.')}}</p>
        </div>
      </div>
    </div>


    <div class="bg-white shadow rounded-lg p-6 mt-3">
      <h2 class="text-lg font-semibold mb-4 text-gray-700">5 Pelanggan Setia Anda 🤩</h2>
      <table class="w-full border-collapse border border-gray-300 text-sm">
        <thead>
          <tr class="bg-green-300 text-slate-950">
            <th class="border border-gray-300 px-4 py-2">No</th>
            <th class="border border-gray-300 px-4 py-2">Nama</th>
            <th class="border border-gray-300 px-4 py-2">HP</th>
            <th class="border border-gray-300 px-4 py-2">Order</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($this->pelanggan as $key => $pelanggan)
          <tr class="bg-gray-50 text-gray-700">
            <td class="border border-gray-300 px-4 py-2 text-center">{{$key+1}}</td>
            <td class="border border-gray-300 px-4 py-2 text-center">{{$pelanggan->nama}}</td>
            <td class="border border-gray-300 px-4 py-2 text-center">{{$pelanggan->no_hp}}</td>
            <td class="border border-gray-300 px-4 py-2 text-center">{{$pelanggan->total_orders}} kali</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  </x-filament::page>