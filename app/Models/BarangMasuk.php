<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BarangMasuk extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table = 'barang_masuk';

    protected $fillable = [
        "id_masuk", 'tanggal_masuk',  'jumlah_masuk', 'produk_id', 'batch', 'tanggal_kadaluarsa', 'stok_tersisa'
    ];
    protected $hidden = [
        'deleted_at'
    ];


    public function produk(){
        return $this->belongsTo(produk::class);
    }
}
