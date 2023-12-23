<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailtran extends Model
{
    use HasFactory;

    protected $table = "transaksi_detail";

    protected $fillable = ["transaksi_id", "qty", "total"];
}
