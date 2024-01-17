<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi_detail extends Model
{
    use HasFactory;

    protected $table = "transaksi_detail";

    protected $fillable = [ "produk_id","transaksi_id",  "stok_keluar", "harga_jual"];


    public function transaksi() {

        return $this->belongsTo(transaksi2::class, 'transaksi_id', 'id');
    }

    public function produk(){
        return $this->belongsToMany(produk::class);
    }


}
