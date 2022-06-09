<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class masterDataModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'harga',
        'nama',
        'jenis',
    ];
}
