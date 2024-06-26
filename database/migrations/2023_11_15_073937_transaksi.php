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
        // Schema::create('transaksi2s', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('kode_transaksi')->nullable();
        //     $table->date('tanggal_transaksi');
        //     $table->integer('harga_jual');
        //     $table->integer('harga_akhir');
        //     $table->integer('stok_keluar');
        //     $table->integer('diskon')->default(0);
        //     $table->foreignId('produk_id')->references('id')->on('produk');
        //     // $table->integer('total');
        //     // $table->integer('bayar');
        //     $table->foreignId('salesman_id')->references('id')->on('salesman');
        //     $table->foreignId('customer_id')->references('id')->on('customer');
        //     $table->timestamps();
        // });
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->nullable();
            $table->date('tanggal_transaksi');

            $table->integer('total');
            $table->integer('diskon')->nullable();
            $table->integer('subtotal');
            $table->foreignId('salesman_id')->nullable()->references('id')->on('salesman')->nullOnDelete();
            $table->foreignId('customer_id')->nullable()->references('id')->on('customer')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
