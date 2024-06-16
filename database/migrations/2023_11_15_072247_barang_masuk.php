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
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->id();
            $table->string('id_masuk')->nullable();
            $table->date('tanggal_masuk');
            $table->string('batch');
            $table->date('tanggal_kadaluarsa');
            $table->integer('jumlah_masuk');
            $table->integer('stok_tersisa');
            $table->foreignId('produk_id')->nullable()->references('id')->on('produk')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuk');
    }
};
