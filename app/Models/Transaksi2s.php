<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi2s extends Model
{
    use HasFactory;

    protected $table = 'transaksi2s';

    protected $fillable = ["kode_transaksi", "tanggal_transaksi", "harga_jual", "stok_keluar", "produk_id","salesman_id", "customer_id", "diskon", "harga_akhir"];


    public function salesman() {

        return $this->belongsTo(salesman::class);
    }

    public function customer() {

        return $this->belongsTo(customer::class);
    }

    public function produk(){
        return $this->belongsTo(produk::class);
    }
}


