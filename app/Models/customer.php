<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;

    protected $table = 'customer';

    protected $fillable = [
        "nama_customer", "no_telp", "alamat", "kode"


    ];

    public function transaksi() {

        return $this->hasMany(Transaksi::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $model->kode = 'CTM' . '-' . str_pad($model->id, 3, '0', STR_PAD_LEFT);
            $model->save();

        });
    }
}
