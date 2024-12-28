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
        Schema::create('pelanggan_pivot_pelayanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pelanggan')->constrained('pelanggans')->cascadeOnDelete();
            $table->foreignId('id_pembayaran')->constrained('pembayarans')->cascadeOnDelete();
            $table->dateTime('tanggal_pesanan');
            $table->string('penginput');
            $table->string('no_pesanan');
            $table->double('total');
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan_pivot_pelayanans');
    }
};
