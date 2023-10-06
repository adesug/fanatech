<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   

    public function index()
    {
        $inventoryCount= DB::table('inventories')->count();
        $purchasesCount= DB::table('purchases')->count();
        $salesCount= DB::table('sales')->count();
        // return view('home');
        if(request()->user()->role == 'SuperAdmin'){
            return view('superAdminHome',compact('inventoryCount','purchasesCount','salesCount'));
        }else if(request()->user()->role == 'Sales'){
            return view('salesHome');
        }else if(request()->user()->role == 'Purchase') {
            return view('purchaseHome');
        }else if(request()->user()->role == 'Manager') {
            return view('managerHome');
        }else {
            return redirect('/login');
        }
    }
    // public function superAdminHome() 
    // {
    //     return view('SuperAdminHome');
    // }
    // public function salesHome()
    // {
    //     return view('salesHome');
    // }
    // public function purchaseHome()
    // {
    //     return view('purchaseHome');
    // }
    // public function managerHome() 
    // {
    //     return view('managerHome');
    // }
}
