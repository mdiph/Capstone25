<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi2 extends Model
{
    use HasFactory;

    protected $table = 'transaksi2s';

    protected $fillable = ["tanggal_transaksi", "subtotal", "total", "diskon", "customer_id", "salesman_id"];

    public function salesman() {

        return $this->belongsTo(salesman::class);
    }

    public function customer() {

        return $this->belongsTo(customer::class);
    }

    public function detail() {

        return $this->hasOne(transaksi_detail::class, 'id');
    }

}
