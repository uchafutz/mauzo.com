<?php

use App\Http\Controllers\Config\OrganizationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Config\RoleController;
use App\Http\Controllers\Config\UnitController;
use App\Http\Controllers\Config\UnitTypeController;
use App\Http\Controllers\Config\User\UserController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Inventory\InventoryCategoryController;
use App\Http\Controllers\Inventory\InventoryItemController;
use App\Http\Controllers\Inventory\InventoryItemMaterialController;
use App\Http\Controllers\Inventory\InventoryWarehouseController;
use App\Http\Controllers\Inventory\ManufacturingController;
use App\Http\Controllers\Inventory\ManufacturingGenrateBOQController;
use App\Http\Controllers\Inventory\ManufacturingMaterialStockAssignmentController;
use App\Http\Controllers\Purchase\PurchaseController;
use App\Http\Controllers\Purchase\PurchaseSubmittedController;
use App\Http\Controllers\Config\User\AssignUserRolesController;
use App\Http\Controllers\Config\Role\AssignRolePermissionController;
use App\Http\Controllers\Config\User\AssignUserPermissionController;
use App\Http\Controllers\Config\VatController;
use App\Http\Controllers\Inventory\ManufacturingSubmitController;
use App\Http\Controllers\Sale\Invoice\RequestInvoice;
use App\Http\Controllers\Sale\SaleController;
use App\Http\Controllers\Sale\SaleSubmitController;
use App\Http\Controllers\Stock\StockSubmitTransferController;
use App\Http\Controllers\Stock\StockTransferController;
use App\Models\Stock\StockTransfer;

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
    return redirect(route('login'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::get('/forgot-password', function () {
//     return view('auth.forgot-password');
// })->middleware('guest')->name('password.request');

Route::middleware("auth")->group(function () {

    Route::prefix("/config")->name("config.")->group(function () {
        Route::resource("unitTypes", UnitTypeController::class);
        Route::resource("units", UnitController::class);
        Route::resource("roles", RoleController::class);
        Route::resource("organizations", OrganizationController::class);
        Route::post("roles/{role}/assign-role-permission", AssignRolePermissionController::class)->name("roles.assignPermissions");

        Route::resource("users", UserController::class);
        Route::post("users/{user}/assign-roles", AssignUserRolesController::class)->name("users.assignRoles");
        Route::post("users/{user}/assign-permission", AssignUserPermissionController::class)->name("users.assignPermissions");
        Route::resource("vats", VatController::class);
    });

    Route::prefix("/inventory")->name("inventory.")->group(function () {
        Route::resource("inventoryCategories", InventoryCategoryController::class);
        Route::resource("inventoryItems", InventoryItemController::class);
        Route::resource("inventoryWarehouses", InventoryWarehouseController::class);
        Route::resource("inventoryItems.inventoryItemMaterials", InventoryItemMaterialController::class);
        Route::resource("manufacturings", ManufacturingController::class);
        Route::post("manufacturings/{manufacturing}/generate-boq", ManufacturingGenrateBOQController::class)->name("manufacturings.generateBOQ");
        Route::post("manufacturings/{manufacturing}/material/{manufacturingMaterial}/assign-stock-items", ManufacturingMaterialStockAssignmentController::class)->name("manufacturings.materials.assignStock");
        Route::post("manufacturings/{manufacturing}/submit", ManufacturingSubmitController::class)->name("manufacturings.submit");
    });

    Route::prefix("/purchase")->name("purchase.")->group(function () {
        Route::resource("purchases", PurchaseController::class);
        Route::post("purchases/{purchase}/purchase-submited", PurchaseSubmittedController::class)->name("purchases.purchaseSubmited");
    });

    Route::prefix("/customer")->name("customer.")->group(function () {
        Route::resource("customers", CustomerController::class);
    });

    Route::prefix("/sale")->name("sale.")->group(function () {
        Route::resource("sales", SaleController::class);
        Route::post("sales/{sale}/sale-submited", SaleSubmitController::class)->name("sales.submit");
        Route::get("sales/{sale}/{type}", RequestInvoice::class)->name("sales.invoice");
    });

    Route::prefix("/stock")->name("stock.")->group(function () {
        Route::resource("stockTransfers", StockTransferController::class);
        Route::post("stockTransfers/{stockTransfer}/submited", StockSubmitTransferController::class)->name("stockTransfer.submited");
    });
});
