<?php

namespace App\Http\Controllers;

use App\Models\kasir;
use App\Models\masterDataModel;
use Illuminate\Http\Request;
use App\Http\Requests\StorekasirRequest;
use App\Http\Requests\UpdatekasirRequest;

class KasirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kasir.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kasir.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorekasirRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorekasirRequest $request)
    {
        $count = kasir::select('idTransaksi')->where('idTransaksi', 'like','%001'.date('dmY'))->groupBy('idTransaksi')->get()->count();

        $idTransaksi = str_pad(strval($count+1),4,'0',STR_PAD_LEFT).'001'.date('dmY');

        foreach($request->listMenu as $data){
            $kasir = new kasir;
            $kasir->masterData = $data['id'];
            $kasir->idTransaksi = $idTransaksi;
            $kasir->atasNama = $request->atasNama;
            $kasir->nomorMeja = $request->nomorMeja;
            $kasir->jumlah = $data['jumlah'];
            $kasir->status = 1;
            $kasir->save();
        }

        return $kasir;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kasir  $kasir
     * @return \Illuminate\Http\Response
     */
    public function show(kasir $kasir)
    {   
        if (request()->ajax()) {
            if(request()->idTransaksi){
                return kasir::getPesananByID(request()->idTransaksi);
            }elseif(request()->laporanPenjualan){
                return kasir::getLaporanPenjualan(request()->all());
            }else{
                return kasir::getAllPesanan(intval(request()->status));
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kasir  $kasir
     * @return \Illuminate\Http\Response
     */
    public function edit(kasir $kasir)
    {
        return view('kasir.edit');
    }

    public function laporan(kasir $kasir)
    {   
        $jenis = masterDataModel::getJenis(request()->jenis);
        $kasir = $kasir::getPesananByJenis($jenis);
        
        return view('kasir.laporan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatekasirRequest  $request
     * @param  \App\Models\kasir  $kasir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $dataInput = array_combine($request->id,$request->jumlah);
        $dataTransaksi = new kasir;
        $dataTransaksi = $dataTransaksi->where('idTransaksi', $id)->get();
        foreach ($dataInput as $key => $value) {
            if (substr($key, 0, 3) == 'new') {
                $kasir = new kasir;
                $kasir->masterData = substr($key, 3);
                $kasir->idTransaksi = $id;
                $kasir->atasNama = $dataTransaksi[0]->atasNama;
                $kasir->nomorMeja = $dataTransaksi[0]->nomorMeja;
                $kasir->jumlah = $value;
                $kasir->status = 1;
                $kasir->save();
            }
        }

        foreach ($dataTransaksi as $value) {
            $kasir = new kasir;
            if(!in_array($value->id,$request->id)){
                $kasir = $kasir->find($value->id);
                $kasir->delete();
            }else{
                $kasir = $kasir->find($value->id);
                $kasir->jumlah = $dataInput[$value->id];
                $kasir->save();
            }
        }

        return view('kasir.edit');
    }

    public function bayar(kasir $kasir,$id)
    {   
        $kasir::updateStatus($id);
        return view('kasir.edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kasir  $kasir
     * @return \Illuminate\Http\Response
     */
    public function destroy(kasir $kasir,$id)
    {
        $kasir = new kasir;
        $kasir = $kasir->where('idTransaksi', $id)->delete();
        return view('kasir.edit');
    }
}
