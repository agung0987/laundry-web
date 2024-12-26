<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('t_pengeluarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pengeluaran')->constrained('pengeluarans')->cascadeOnDelete();
            $table->foreignId('id_pelanggan')->constrained('pelanggans')->cascadeOnDelete();
            $table->date('tanggal');
            $table->integer('jumlah');
            $table->integer('tarif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_pengeluarans');
    }
};
