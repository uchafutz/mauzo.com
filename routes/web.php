<?php

use App\Http\Controllers\Config\RoleController;
use App\Http\Controllers\Config\UnitController;
use App\Http\Controllers\Config\UnitTypeController;
use App\Http\Controllers\Config\User\AssignUserRolesController;
use App\Http\Controllers\Config\User\UserController;
use App\Http\Controllers\Inventory\InventoryCategoryController;
use App\Http\Controllers\Inventory\InventoryItemController;
use App\Http\Controllers\Inventory\InventoryItemMaterialController;
use App\Http\Controllers\Inventory\InventoryWarehouseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::middleware("auth")->group(function () {

    Route::prefix("/config")->name("config.")->group(function () {
        Route::resource("unitTypes", UnitTypeController::class);
        Route::resource("units",UnitController::class);
        Route::resource("roles", RoleController::class);
        
        Route::resource("users", UserController::class);
        Route::post("users/{user}/assign-roles", AssignUserRolesController::class);
    });
    
    Route::prefix("/inventory")->name("inventory.")->group(function(){
        Route::resource("inventoryCategories",InventoryCategoryController::class);
        Route::resource("inventoryItems",InventoryItemController::class);
        Route::resource("inventoryWarehouses", InventoryWarehouseController::class);
        Route::resource("inventoryItems.inventoryItemMaterials",InventoryItemMaterialController::class);
    });
  
});


