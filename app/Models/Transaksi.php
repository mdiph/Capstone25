<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;
    

    protected $table = 'transaksi';
    protected $primaryKey = 'id';

    protected $fillable = ["kode_transaksi", "tanggal_transaksi", "tanggal_kedaluwarsa", "subtotal", "total", "diskon", "customer_id", "salesman_id"];

    public function salesman() {

        return $this->belongsTo(salesman::class, 'salesman_id', 'id');
    }

    public function customer() {

        return $this->belongsTo(customer::class);
    }

    public function detailTransaksi() {

        return $this->hasMany(transaksi_detail::class);
    }

    public function pembayaran() {

        return $this->hasOne(Pembayaran::class);
    }

}
