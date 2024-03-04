<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class transaksi_detail extends Model
{
    use HasFactory;
    

    protected $table = "transaksi_detail";

    protected $fillable = [ "produk_id","transaksi_id",  "stok_keluar", "harga_jual", "diskon", "total", "no_batch", "tanggal_kedaluwarsa"];

    protected $appends = ['subtotal'];


    public function transaksi() {

        return $this->belongsTo(Transaksi::class);
    }

    public function produk(){
        return $this->belongsTo(produk::class);
    }

    public function getsubtotalAttribute()
    {
        return $this->stok_keluar * $this->harga_jual;
    }

}
