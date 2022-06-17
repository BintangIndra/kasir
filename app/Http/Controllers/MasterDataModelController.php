<?php

namespace App\Http\Controllers;

use App\Models\masterDataModel;
use App\Http\Requests\StoremasterDataModelRequest;
use App\Http\Requests\UpdatemasterDataModelRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $validatedData = $request->validate([
            'file' => 'required|mimes:jpg,bmp,png,jpeg|max:2048',
            'name' => 'required',
            'jenis' => 'required',
            'harga' => 'required',
        ]);

        // $name = $request->file('file')->hashName();
 
        // $path = $request->file('file')->store('public/masterData/images');

        $imageName = $request->file('file')->hashName();
        $request->file->move(public_path('images'), $imageName);

        $masterDataModel = new masterDataModel;
        $masterDataModel->nama = $request->name;
        $masterDataModel->jenis = $request->jenis;
        $masterDataModel->harga = $request->harga;
        $masterDataModel->imageUrl = $imageName;
        $masterDataModel->save();

        return  view('masterData.index');

        
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
    public function destroy($id)
    {   
        $masterDataModel = new masterDataModel;
        $masterDataModel = $masterDataModel->find($id);
        $imageName = $masterDataModel->imageUrl;
        unlink(public_path('images').'/'.$imageName);
        $masterDataModel->delete();
        
        return  view('masterData.index');
    }
}