<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangkeluar extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar';

    protected $fillable = [
        'id_keluar',
        'tanggal_keluar',
        'tanggal_expired',
        'jumlah_keluar',
        'harga_jual',
        'produk_id',
        'transaksi_id'
    ];
    protected $hidden = [
        'deleted_at'
    ];


    public function produk(){
        return $this->belongsTo(produk::class);
    }

    public function transaksi(){
        return $this->belongsTo(Transaksi::class);
    }
}
