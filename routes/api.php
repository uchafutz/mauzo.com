<?php

use App\Http\Controllers\Config\Role\AssignRolePermissionController;
use App\Http\Controllers\Config\RoleController;
use App\Http\Controllers\Config\UnitTypeController;
use App\Http\Controllers\Config\UnitController;
use App\Http\Controllers\Config\User\AssignUserPermissionController;
use App\Http\Controllers\Config\User\AssignUserRolesController;
use App\Http\Controllers\Config\User\UserController;
use App\Http\Controllers\Inventory\InventoryCategoryController;
use App\Http\Controllers\Inventory\InventoryItemController;
use App\Http\Controllers\Inventory\InventoryItemMaterialController;
use App\Http\Controllers\Inventory\InventoryWarehouseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware("auth:sanctum")->name("api.")->group(function () {
    
    Route::prefix("/config")->name("config.")->group(function () {
        Route::resource("unitTypes", UnitTypeController::class);
        ROute::resource("units",UnitController::class);
        Route::resource("roles",RoleController::class);
        Route::post("roles/{role}/assign-role-permission",AssignRolePermissionController::class)->name("roles.assignPermissions");

        Route::resource("users",UserController::class);
        Route::post("users/{user}/assign-roles", AssignUserRolesController::class)->name("users.assignRoles");
        Route::post("users/{user}/assign-permission",AssignUserPermissionController::class)->name("users.assignPermissions");
    });
  
  Route::prefix("/inventory")->name("inventory.")->group(function(){
       Route::resource("inventoryCategories",InventoryCategoryController::class);
       Route::resource("inventoryItems",InventoryItemController::class);
       Route::resource("inventoryWarehouses", InventoryWarehouseController::class);
       Route::resource("inventoryItems.inventoryItemMaterials",InventoryItemMaterialController::class);
  });

  

});