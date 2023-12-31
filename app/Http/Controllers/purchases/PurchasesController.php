<?php

namespace App\Http\Controllers\purchases;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchases_detail;
use App\Models\Inventory;
use App\Models\Purchases;
use Auth;
use Redirect;
use Illuminate\Support\Facades\DB;

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
        $inventory = Inventory::get();
        $purchases = Purchases::get();
        return view('purchases.create',compact('inventory','purchases'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'qty.*' => 'required',
            'price.*' => 'required',
            'purchases_id.*' => 'required',
            'inventory_id.*' => 'required',
        ]);

        $response = DB::transaction(function () use ($request) {
            
        foreach ($request->inventory_id as $key => $value) {
            $inventory_id = $request->inventory_id[$key];
            $purchases_id = $request->purchases_id[$key];
            $qty = $request->qty[$key];
            $price = $request->price[$key];
            // dd($inventory_id);
            $dataStock = Inventory::find($inventory_id);
            $stockAwal = $dataStock->stock;
            $stockTotal = $stockAwal+$qty;
            

            $updateInventory = $dataStock->update([
                'stock' => $stockTotal,
                'price' => $price 
            ]);

            if(!$updateInventory) {
                return false;
            }


            Purchases_detail::create([
                'inventory_id' => $inventory_id,
                'purchases_id' => $purchases_id,
                'qty' => $qty,
                'price' => $price,
            ]);
        }
            return true;
            });


        return redirect::back();
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
