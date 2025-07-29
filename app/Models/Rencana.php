<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rencana extends Model
{
     use HasFactory;

    protected $fillable = [
        'nama_seksi',
        'saldo_tahunan',
        'minggu_1',
        'minggu_2',
        'minggu_3',
        'minggu_4',
        'sisa_saldo_bulan',
        'bulan',
    ];
}
