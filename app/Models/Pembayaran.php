<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        "transaksi_id", "status", "metode", "tanggal_bayar",  "bayar", "jatuh_tempo"


    ];

    public function transaksi() {

        return $this->belongsTo(Transaksi::class);
    }

    public function piutang() {

        return $this->hasMany(Piutang::class);
    }
}
