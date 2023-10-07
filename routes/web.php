<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\superAdmin\adminInventoryController;
use App\Http\Controllers\superAdmin\adminSalesController;
use App\Http\Controllers\superAdmin\adminPurchasesController;
use App\Http\Controllers\purchases\PurchasesController;
use App\Http\Controllers\sales\SalesController;

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
    Route::post('admin/inventory/store',[adminInventoryController::class,'store'])->name('admin.inventoryStore');
    Route::post('admin/inventory/delete/{id}',[adminInventoryController::class,'destroy'])->name('admin.inventoryDestroy');
    Route::post('admin/inventory/edit',[adminInventoryController::class,'edit'])->name('admin.inventoryEdit');
    Route::post('admin/inventory/update',[adminInventoryController::class,'update'])->name('admin.inventoryUpdate');

    Route::get('admin/sales',[adminSalesController::class,'index'])->name('admin.sales');
    Route::post('admin/sales/Store',[adminSalesController::class,'store'])->name('admin.salesStore');
    Route::post('admin/sales/delete/{id}',[adminSalesController::class,'destroy'])->name('admin.salesDestroy');
    Route::post('admin/sales/edit',[adminSalesController::class,'edit'])->name('admin.salesEdit');
    Route::post('admin/sales/update',[adminSalesController::class,'update'])->name('admin.salesUpdate');

    Route::get('admin/purchases',[adminPurchasesController::class,'index'])->name('admin.purchases');
    Route::post('admin/purchases/store',[adminPurchasesController::class,'store'])->name('admin.purchasesStore');
    Route::post('admin/purchases/delete/{id}',[adminPurchasesController::class,'destroy'])->name('admin.purchasesDestroy');
    Route::post('admin/purchases/edit',[adminPurchasesController::class,'edit'])->name('admin.purchasesEdit');
    Route::post('admin/purchases/update',[adminPurchasesController::class,'update'])->name('admin.purchasesUpdate');
});

Route::group(['middleware' => ['auth','role:Sales']], function() {
    Route::get('sales/home',[HomeController::class,'salesHome'])->name('sales.home');

    Route::get('sales/index',[SalesController::class,'index'])->name('sales.index');
    Route::get('sales/index/create',[SalesController::class,'create'])->name('sales.indexCreate');
    Route::post('sales/index/store',[SalesController::class,'store'])->name('sales.indexStore');
    Route::post('sales/index/delete/{id}',[SalesController::class,'destroy'])->name('sales.indexDestroy');
    Route::post('sales/index/edit',[SalesController::class,'edit'])->name('sales.indexEdit');
    Route::post('sales/index/update',[SalesController::class,'update'])->name('sales.indexUpdate');
});

Route::group(['middleware' =>['auth','role:Purchase']], function() {
    Route::get('purchase/home',[HomeController::class,'purchaseHome'])->name('purchase.home');

    Route::get('purchases/index',[PurchasesController::class,'index'])->name('purchases.index');
    Route::get('purchases/index/create',[PurchasesController::class,'create'])->name('purchases.indexCreate');
    Route::post('purchases/index/store',[PurchasesController::class,'store'])->name('purchases.indexStore');
    Route::post('purchases/index/delete/{id}',[PurchasesController::class,'destroy'])->name('purchases.indexDestroy');
    Route::post('purchases/index/edit',[PurchasesController::class,'edit'])->name('purchases.indexEdit');
    Route::post('purchases/index/update',[PurchasesController::class,'update'])->name('purchases.indexUpdate');
});

Route::group(['middleware' => ['auth','role:Manager']], function() {
    Route::get('manager/home',[HomeController::class,'managerHome'])->name('manager.home');
});




