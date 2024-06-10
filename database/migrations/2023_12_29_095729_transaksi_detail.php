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
        Schema::create('transaksi_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->references('id')->on('transaksi')->onUpdate('cascade')->onDelete('cascade');
            $table->string('no_batch');
            $table->date('tanggal_kedaluwarsa');
            $table->foreignId('produk_id')->nullable()->references('id')->on('produk')->nullOnDelete();
            $table->integer('stok_keluar');
            $table->integer('harga_jual');
            $table->integer('diskon');
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_detail');
    }
};
