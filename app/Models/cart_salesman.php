<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart_salesman extends Model
{
    use HasFactory;


    protected $table = 'cart_salesman';

    protected $fillable = [
         "produk_id",
         "no_batch",
         "tanggal_kedaluwarsa",
         "harga_jual",
         "jumlah_keluar",
         "diskon",
         "total",
         "salesman_id"
    ];

    public function produk(){
        return $this->belongsTo(produk::class);
    }

    public function salesman(){
        return $this->belongsTo(salesman::class);
    }



}
