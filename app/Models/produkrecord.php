<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produkrecord extends Model
{
    use HasFactory;

    protected $table = 'produk_record';

    protected $fillable = [
        'produk_id',
        'tanggal',
        'stok'
    ];


    public function produk(){
        return $this->belongsTo(produk::class);
    }
}
