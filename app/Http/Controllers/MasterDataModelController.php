<?php

namespace App\Http\Controllers;

use App\Models\masterDataModel;
use App\Http\Requests\StoremasterDataModelRequest;
use App\Http\Requests\UpdatemasterDataModelRequest;

class MasterDataModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return masterDataModel::all();
        }
        
        return  view('masterData.index');
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
     * @param  \App\Http\Requests\StoremasterDataModelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\masterDataModel  $masterDataModel
     * @return \Illuminate\Http\Response
     */
    public function show(masterDataModel $masterDataModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\masterDataModel  $masterDataModel
     * @return \Illuminate\Http\Response
     */
    public function edit(masterDataModel $masterDataModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatemasterDataModelRequest  $request
     * @param  \App\Models\masterDataModel  $masterDataModel
     * @return \Illuminate\Http\Response
     */
    public function update(masterDataModel $masterDataModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\masterDataModel  $masterDataModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(masterDataModel $masterDataModel)
    {
        //
    }
}
