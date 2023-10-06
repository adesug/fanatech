<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect;

class adminInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventory = DB::table('inventories')->get();
        return view('superAdmin.inventory.index',compact('inventory'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $code = $request->code;
        $name = $request->name;
        $price = $request->price;
        $stock = $request->stock;

        $data = [
            'code' => $code,
            'name' => $name,
            'price' => $price,
            'stock' => $stock
        ];
        $simpan = DB::table('inventories')->insert($data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $data = DB::table('inventories')->where('id',$id)->first();
        return view('superAdmin.inventory.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $code = $request->code;
        $name = $request->name;
        $price = $request->price;
        $stock = $request->stock;

        $data = [
            'code' => $code,
            'name' => $name,
            'price' => $price,
            'stock' => $stock,
        ];
        $simpan = DB::table('inventories')->where('id',$id)->update($data);
        return redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = DB::table('inventories')->where('id',$id)->delete();
        if($delete) {
            return redirect::back();
        }else {
            dd($delete);
        }
    }
}
