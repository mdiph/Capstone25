<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class salesman extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table = 'salesman';

    protected $fillable = [
        "nama_salesman", "no_telp", "kode"


    ];
    protected $dates = ['deleted_at'];

    public function transaksi() {

        return $this->hasMany(Transaksi::class, 'salesman_id', 'id');
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
