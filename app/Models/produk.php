<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        "nama_produk", "deskripsi", "harga", "satuan", "unit", "kategori_id"


    ];


    public function kategori() {

        return $this->belongsTo(kategori::class);
    }

    public function barangMasuk() {

        return $this->hasMany(BarangMasuk::class);
    }
}
