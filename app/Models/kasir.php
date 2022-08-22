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

    public function getAllPesanan($status){
        return DB::table('kasirs')
                    ->select(DB::raw("*,idTransaksi,atasNama,nomorMeja, SUM(master_data_models.harga * kasirs.jumlah) as count, kasirs.created_at"))
                    ->join('master_data_models', 'kasirs.masterData', '=', 'master_data_models.id')
                    ->groupBy('idTransaksi')
                    ->where('kasirs.status','=',$status)
                    ->get();
    }

    public function getPesananByID($data){
        return DB::table('kasirs')
                    ->select(DB::raw("*,kasirs.id as id"))
                    ->join('master_data_models', 'kasirs.masterData', '=', 'master_data_models.id')
                    ->where('kasirs.idTransaksi','=',$data)
                    ->get();
    }

    public function getPesananByJenis($data){
        return DB::table('kasirs')
                    ->select(DB::raw("*,kasirs.id as id"))
                    ->join('master_data_models', 'kasirs.masterData', '=', 'master_data_models.id')
                    ->whereIn('master_data_models.jenis', $data)
                    ->get();
    }

    public function getLaporanPenjualan($data){
        $date = $data['date'] == null ? date('Y-m-d'): $data['date'].' 00:00:00';
        $date1 = $data['date1'] == null ? date('Y-m-d'): $data['date1'].' 00:00:00';
        // dd($date,$date1);
        $kasir = new kasir;
        switch ($data['getBy']) {
            case '1':
                $kasir = $kasir
                ->select('*','kasirs.created_at as created_at')
                ->where('master_data_models.jenis', 'like', '%'.$data['data'] == null ? '': $data['data'].'%')
                ->where('kasirs.status','=','0')
                ->whereBetween('kasirs.created_at', [$date, $date1])
                ->join('master_data_models', 'kasirs.masterData', '=', 'master_data_models.id')
                ->get()
                ;
              break;
            case '2':
                $kasir = $kasir
                ->select('*','kasirs.created_at as created_at')
                ->where('master_data_models.nama', 'like', '%'.$data['data'] == null ? '': $data['data'].'%')
                ->where('kasirs.status','=','0')
                ->whereBetween('kasirs.created_at', [$date, $date1])
                ->join('master_data_models', 'kasirs.masterData', '=', 'master_data_models.id')
                ->get()
                ;
              break;
            default:
                $kasir = [];
        }
        return $kasir;
    }

    public function getLaporanBulanan($month){
        $date = $month == null ? date('Y-m-d'): $month.'-01 00:00:00';
        $date1 = $month == null ? date('Y-m-d'): date("Y-m-d", strtotime($month."next month last day")).' 00:00:00';

        return DB::table('kasirs')
            ->select(DB::raw("idTransaksi,atasNama,nomorMeja,kasirs.created_at,SUM(master_data_models.harga * kasirs.jumlah) as count,SUM(master_data_models.harga * kasirs.jumlah / 10) as pajak"))
            ->join('master_data_models', 'kasirs.masterData', '=', 'master_data_models.id')
            ->groupBy('idTransaksi')
            ->where('kasirs.status','=','0')
            ->whereBetween('kasirs.created_at', [$date, $date1])
            ->get()
            ;
    }

    public function updateStatus($data){
        $kasir = new kasir;
        $kasir = $kasir->where('idTransaksi', $data)->update(['status' => 0]);
    }
}
