<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $fillable = ["kode_transaksi", "tanggal_transaksi", "total", "bayar", "salesman_id", "customer_id"];
}
