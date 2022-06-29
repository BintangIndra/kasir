<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kasir extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'masterData',
        'idTransaksi',// '000100110122014'
        'atasNama',
        'nomorMeja',
        'jumlah',
        'status'
    ];
}
