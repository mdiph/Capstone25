<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk';

    protected $fillable = [
        "id_masuk", 'tanggal_masuk', 'tanggal_expired', 'jumlah_masuk', 'produk_id'
    ];


    public function produk(){
        return $this->belongsTo(produk::class);
    }
}
