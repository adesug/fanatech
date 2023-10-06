<?php

namespace App\Http\Controllers\purchases;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchases_detail;
use Auth;
use Redirect;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaseDetails = Purchases_detail::whereHas('purchases', function($query){
            return $query->where('user_id','=',Auth::user()->id);
        })->with('purchases')->with('inventory')->get();
        // echo json_encode($tes);
        return view('purchases.index',compact('purchaseDetails'));
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
        //
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

        $purchasesDetails = Purchases_detail::where('id',$id)->with('purchases')->with('inventory')->first();

        return view('purchases.edit',compact('purchasesDetails'));
        


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
        $price = $request->price;
        $qty = $request->qty;

        $data = [
            'price' => $price,
            'qty' => $qty,
        ];
        $simpan = Purchases_detail::where('id',$id)->update($data);
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
        $delete = Purchases_detail::where('id',$id)->delete();
        if($delete) {
            return redirect::back();
        }else {
            dd($delete);
        }
    }
}
