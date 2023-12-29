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
        Schema::create('transaksi2s', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->nullable();
            $table->date('tanggal_transaksi');
            $table->integer('total');
            $table->integer('diskon');
            $table->integer('bayar');
            $table->foreignId('salesman_id')->references('id')->on('salesman');
            $table->foreignId('customer_id')->references('id')->on('customer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi2s');
    }
};
