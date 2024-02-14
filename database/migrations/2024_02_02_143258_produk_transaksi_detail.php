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
        Schema::create('produk_transaksi_detail', function (Blueprint $table) {
            $table->id();
        $table->unsignedBigInteger('produk_id');
        $table->unsignedBigInteger('transaksi_id');

        $table->timestamps();

        $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade');
        $table->foreign('transaksi_id')->references('id')->on('transaksi2s')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_transaksi_detail');
    }
};
