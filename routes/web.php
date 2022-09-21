<?php

use App\Http\Controllers\Config\Role\AssignRolePermissionController;
use App\Http\Controllers\Config\RoleController;
use App\Http\Controllers\Config\UnitController;
use App\Http\Controllers\Config\UnitTypeController;
use App\Http\Controllers\Config\User\AssignUserPermissionController;
use App\Http\Controllers\Config\User\AssignUserRolesController;
use App\Http\Controllers\Config\User\UserController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Inventory\InventoryCategoryController;
use App\Http\Controllers\Inventory\InventoryItemController;
use App\Http\Controllers\Inventory\InventoryItemMaterialController;
use App\Http\Controllers\Inventory\InventoryWarehouseController;
use App\Http\Controllers\Purchase\PurchaseController;
use App\Http\Controllers\Purchase\PurchaseSubmittedController;
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
        Route::post("roles/{role}/assign-role-permission",AssignRolePermissionController::class)->name("roles.assignPermissions");
        
        Route::resource("users", UserController::class);
        Route::post("users/{user}/assign-roles", AssignUserRolesController::class)->name("users.assignRoles");
        Route::post("users/{user}/assign-permission",AssignUserPermissionController::class)->name("users.assignPermissions");
    });
    
    Route::prefix("/inventory")->name("inventory.")->group(function(){
        Route::resource("inventoryCategories",InventoryCategoryController::class);
        Route::resource("inventoryItems",InventoryItemController::class);
        Route::resource("inventoryWarehouses", InventoryWarehouseController::class);
        Route::resource("inventoryItems.inventoryItemMaterials",InventoryItemMaterialController::class);
    });

    Route::prefix("/purchase")->name("purchase.")->group(function(){
        Route::resource("purchases",PurchaseController::class);
        Route::post("purchases/{purchase}/purchase-submited",PurchaseSubmittedController::class)->name("purchases.purchaseSubmited");
    });

    Route::prefix("/customer")->name("customer.")->group(function(){
      Route::resource("customers",CustomerController::class);
    });
  
});


