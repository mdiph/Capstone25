<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;

    protected $table = 'cart';

    protected $fillable = [
         "produk_id",
         "no_batch",
         "tanggal_kedaluwarsa",
         "harga_jual",
         "jumlah_keluar",
         "diskon",
         "total"
    ];

    public function produk(){
        return $this->belongsTo(produk::class);
    }
}
