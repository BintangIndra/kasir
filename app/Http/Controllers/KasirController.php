<?php

namespace App\Http\Controllers;

use App\Models\kasir;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kasir  $kasir
     * @return \Illuminate\Http\Response
     */
    public function show(kasir $kasir)
    {
        //
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
