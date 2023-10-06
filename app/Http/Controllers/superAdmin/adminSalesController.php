<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect;
use App\Models\Sales;

class adminSalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales =  Sales::with('user')->get();
        $userSales = DB::table('users')->where('role','Sales')->get();
        return view ('superAdmin.sales.index',compact('sales','userSales'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $number = $request->number;
        $date= $request->date;
        $user_id = $request->user_id;
       

        $data = [
            'number' => $number,
            'date' => $date,
            'user_id' => $user_id,
        ];
        // dd($data);
        $simpan = DB::table('sales')->insert($data);
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
        $data =  Sales::with('user')->where('id',$id)->first();
        $userSales = DB::table('users')->where('role','Sales')->get();
        return view('superAdmin.sales.edit', compact('data','userSales'));
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
        $number = $request->number;
        $date = $request->date;
        $user_id = $request->user_id;

        $data = [
            'number' => $number,
            'date' => $date,
            'user_id' => $user_id,
        ];
        $simpan = DB::table('sales')->where('id',$id)->update($data);
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
        $delete = DB::table('sales')->where('id',$id)->delete();
        if($delete) {
            return redirect::back();
        }else {
            dd($delete);
        }
    }
}
