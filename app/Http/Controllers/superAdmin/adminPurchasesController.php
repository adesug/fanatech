<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect;
use App\Models\Purchases;

class adminPurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchases::with('user')->get();
        // echo json_encode($purchases);
        $userPurchases = DB::table('users')->where('role','Purchase')->get();

        return view('superAdmin.purchases.index',compact('purchases','userPurchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        $simpan = DB::table('purchases')->insert($data);
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
        $data = Purchases::with('user')->where('id',$id)->first();
        $userPurchases = DB::table('users')->where('role','Purchase')->get();

        // $userPurchases = DB::table('users')->where('role','Purchase')->get();
        return view('superAdmin.purchases.edit', compact('data','userPurchases'));
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
        $simpan = DB::table('purchases')->where('id',$id)->update($data);
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
        $delete = DB::table('purchases')->where('id',$id)->delete();
        if($delete) {
            return redirect::back();
        }else {
            dd($delete);
        }
    }
}
