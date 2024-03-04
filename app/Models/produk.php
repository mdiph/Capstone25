<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class produk extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'produk';

    protected $fillable = [
        "kode", "nama_produk", "deskripsi", "harga", "satuan",  "kategori_id"


    ];

    protected $dates = ['deleted_at'];
    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {

            $kategoriPrefix = strtoupper(substr($model->kategori->nama_kategori, 0, 2));

            // Count the number of models with the same category
            $count = static::where('kategori_id', $model->kategori->id)->count();

            // Combine the prefix with the count and padded id
            $model->kode = $kategoriPrefix . '-' . str_pad($count + 1, 3, '0', STR_PAD_LEFT);

            $model->save();

        });
    }


    public function kategori() {

        return $this->belongsTo(kategori::class);
    }

    public function barangMasuk() {

        return $this->hasMany(BarangMasuk::class);
    }

    public function barangKeluar() {

        return $this->hasMany(Barangkeluar::class);
    }

    public function cart() {

        return $this->hasMany(cart::class);
    }

    public function detail() {

        return $this->hasMany(transaksi_detail::class);
    }
}
