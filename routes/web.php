<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\superAdmin\adminInventoryController;
use App\Http\Controllers\superAdmin\adminSalesController;
use App\Http\Controllers\superAdmin\adminPurchasesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth','role:SuperAdmin']], function() {
    Route::get('admin/home',[HomeController::class,'index'])->name('superAdmin.home');
    Route::get('admin/inventory',[adminInventoryController::class,'index'])->name('admin.inventory');

    Route::get('admin/sales',[adminSalesController::class,'index'])->name('admin.sales');

    Route::get('admin/purchases',[adminPurchasesController::class,'index'])->name('admin.purchases');
});

Route::group(['middleware' => ['auth','role:Sales']], function() {
    Route::get('sales/home',[HomeController::class,'salesHome'])->name('sales.home');
});

Route::group(['middleware' =>['auth','role:Purchase']], function() {
    Route::get('purchase/home',[HomeController::class,'purchaseHome'])->name('purchase.home');
});

Route::group(['middleware' => ['auth','role:Manager']], function() {
    Route::get('manager/home',[HomeController::class,'managerHome'])->name('manager.home');
});




