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
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('nama_produk');
            $table->string('deskripsi');
            $table->integer('harga');
            $table->string('satuan');
            $table->integer('stok')->default(0);
            // $table->integer('unit');
            $table->foreignId('kategori_id')->nullable()->references('id')->on('kategori')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
