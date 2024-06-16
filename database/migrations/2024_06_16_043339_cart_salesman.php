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
        Schema::create('cart_salesman', function (Blueprint $table) {
            $table->id();
            $table->integer('harga_jual');
            $table->integer('jumlah_keluar');
            $table->string('no_batch');
            $table->date('tanggal_kedaluwarsa');
            $table->integer('diskon');
            $table->integer('total');
            $table->foreignId('salesman_id')->references('id')->on('salesman');
            $table->foreignId('produk_id')->references('id')->on('produk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_salesman');
    }
};
