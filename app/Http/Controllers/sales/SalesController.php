<?php

namespace App\Http\Controllers\sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sales_detail;
use App\Models\Inventory;
use App\Models\Sales;
use Auth;
use Redirect;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Auth::user()->id);
        // $salesDetails = Sales_detail::with('sales')->with('inventory')->get();
        // dd($salesDetails);
        $salesDetails = Sales_detail::whereHas('sales', function($query){
            return $query->where('user_id','=',Auth::user()->id);
        })->with('sales')->with('inventory')->get();
        // dd($salesDetails);

        // echo json_encode($tes);
        return view('sales.index',compact('salesDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $inventory = Inventory::get();
        $sales = Sales::get();
        return view('sales.create',compact('inventory','sales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        
        $request->validate([
            'qty.*' => 'required',
            'price.*' => 'required',
            'inventory_id.*' => 'required',
        ]);

        $response = DB::transaction(function () use ($request) {
            
        foreach ($request->inventory_id as $key => $value) {
            $inventory_id = $request->inventory_id[$key];
            $sales_id = Auth::user()->id;
            $qty = $request->qty[$key];
            $price = $request->price[$key];
            // dd($inventory_id);
            $dataStock = Inventory::find($inventory_id);
            $stockAwal = $dataStock->stock;
            $stockTotal = $stockAwal-$qty;
            
            if($stockAwal < $qty ) {
                return redirect::back()->with('error','Stok tidak mencukupi');
            }
            $updateInventory = $dataStock->update([
                'stock' => $stockTotal,
                // 'price' => $price 
            ]);

            if(!$updateInventory) {
                return false;
            }


            Sales_detail::create([
                'inventory_id' => $inventory_id,
                'sales_id' => $sales_id,
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
        $id= $request->id;
        $salesDetails = Sales_detail::where('id',$id)->with('sales')->with('inventory')->first();
        return view('sales.edit',compact('salesDetails'));
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
        $simpan = Sales_detail::where('id',$id)->update($data);
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
        $delete = Sales_detail::where('id',$id)->delete();
        if($delete) {
           return redirect::back(); 
        }
    }
}
