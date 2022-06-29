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
        'imageUrl',
    ];

    public function getByJenis($data){
        return masterDataModel::where('jenis',$data)->get();
    }

    public function getJenis($data){
        return masterDataModel::select('jenis')->groupBy('jenis')->get();
    }

    public function getId(){
        return masterDataModel::select('id')->groupBy('id')->get();
    }
}
