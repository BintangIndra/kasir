<?php

namespace App\Http\Controllers;

use App\Models\kasir;
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
        //
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
            return kasir::all();
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatekasirRequest  $request
     * @param  \App\Models\kasir  $kasir
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatekasirRequest $request, kasir $kasir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kasir  $kasir
     * @return \Illuminate\Http\Response
     */
    public function destroy(kasir $kasir)
    {
        //
    }
}
