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
        Schema::create('barang_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('id_keluar')->nullable();
            $table->date('tanggal_keluar');

            $table->integer('jumlah_keluar');

            $table->foreignId('produk_id')->nullable()->references('id')->on('produk')->nullOnDelete();
            $table->foreignId('transaksi_id')->references('id')->on('transaksi')->onDelete('cascade')->cascadeOnUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_keluar');
    }
};
