<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = [
        "nama_kategori",


    ];

    public function produk(){
        return $this->hasMany(produk::class);
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::created(function ($model) {
    //         $model->kode = 'SLS' . '-' . str_pad($model->id, 3, '0', STR_PAD_LEFT);
    //         $model->save();

    //     });
    // }
}
