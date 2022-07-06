<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class kasir extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'masterData',
        'idTransaksi',// '000100110122014'
        'atasNama',
        'nomorMeja',
        'id',
        'jumlah',
        'status'
    ];

    public function getAllPesanan(){
        return DB::table('kasirs')
                    ->select(DB::raw("idTransaksi,atasNama,nomorMeja, SUM(master_data_models.harga * kasirs.jumlah) as count"))
                    ->join('master_data_models', 'kasirs.masterData', '=', 'master_data_models.id')
                    ->groupBy('idTransaksi')
                    ->where('kasirs.status','=',1)
                    ->get();
    }

    public function getPesananByID($data){
        return DB::table('kasirs')
                    ->select(DB::raw("*"))
                    ->join('master_data_models', 'kasirs.masterData', '=', 'master_data_models.id')
                    ->where('kasirs.idTransaksi','=',$data)
                    ->get();
    }

    public function updateStatus($data){
        $kasir = new kasir;
        $kasir = $kasir->where('idTransaksi', $data)->update(['status' => 0]);
    }
}
