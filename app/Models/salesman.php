<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salesman extends Model
{
    use HasFactory;


    protected $table = 'salesman';

    protected $fillable = [
        "nama_salesman", "no_telp", "kode"


    ];

    public function transaksi() {

        return $this->hasMany(transaksi2::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $model->kode = 'SLS' . '-' . str_pad($model->id, 3, '0', STR_PAD_LEFT);
            $model->save();

        });
    }
}
