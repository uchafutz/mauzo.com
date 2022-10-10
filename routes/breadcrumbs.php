<?php

use App\Models\Config\Role;
use App\Models\Config\Unit;
use App\Models\Config\UnitType;
use App\Models\Customer\Customer;
use App\Models\Inventory\InventoryCategory;
use App\Models\Inventory\InventoryItem;
use App\Models\Inventory\InventoryItemMaterial;
use App\Models\Inventory\InventoryWarehouse;
use App\Models\Inventory\Manufacturing;
use App\Models\Purchase\Purchase;
use App\Models\Sale\Sale;
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Dashboard', route('home'));
});

Breadcrumbs::for('purchase.purchases.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Purchases', route('purchase.purchases.index'));
});

Breadcrumbs::for('purchase.purchases.create', function ($trail) {
    $trail->parent('purchase.purchases.index');
    $trail->push('Create', route('purchase.purchases.create'));
});

Breadcrumbs::for('purchase.purchases.edit', function ($trail, Purchase $purchase) {
    $trail->parent('purchase.purchases.show', $purchase);
    $trail->push('Edit', route('purchase.purchases.edit', ['purchase' => $purchase]));
});

Breadcrumbs::for('purchase.purchases.show', function ($trail, Purchase $purchase) {
    $trail->parent('purchase.purchases.index');
    $trail->push($purchase->code, route('purchase.purchases.show', ['purchase' => $purchase]));
});

//customer

Breadcrumbs::for('customer.customers.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Customers', route('customer.customers.index'));
});
Breadcrumbs::for('customer.customers.create', function ($trail) {
    $trail->parent('customer.customers.index');
    $trail->push('Create', route('customer.customers.create'));
});

Breadcrumbs::for('customer.customers.edit', function ($trail, Customer $customer) {
    $trail->parent('customer.customers.index');
    $trail->push('Edit', route('customer.customers.edit', ['customer' => $customer]));
});

//inventory Items
Breadcrumbs::for('inventory.inventoryItems.index', function ($trail) {
    $trail->parent('home');
    $trail->push('InventoryItem', route('inventory.inventoryItems.index'));
});

Breadcrumbs::for('inventory.inventoryItems.create', function ($trail) {
    $trail->parent('inventory.inventoryItems.index');
    $trail->push('Create', route('inventory.inventoryItems.create'));
});

Breadcrumbs::for('inventory.inventoryItems.edit', function ($trail, InventoryItem $inventoryItem) {
    $trail->parent('inventory.inventoryItems.index');
    $trail->push('Edit', route('inventory.inventoryItems.edit', ['inventoryItem' => $inventoryItem]));
});

Breadcrumbs::for('inventory.inventoryItems.show', function ($trail, InventoryItem $inventoryItem) {
    $trail->parent('inventory.inventoryItems.index');
    $trail->push($inventoryItem->name, route('inventory.inventoryItems.show', ['inventoryItem' => $inventoryItem]));
});

Breadcrumbs::for('inventory.inventoryItems.inventoryItemMaterials.create', function ($trail, InventoryItem $inventoryItem) {
    $trail->parent('inventory.inventoryItems.show', $inventoryItem);
    $trail->push("Add Material", route('inventory.inventoryItems.inventoryItemMaterials.create', ['inventoryItem' => $inventoryItem]));
});

Breadcrumbs::for('inventory.inventoryItems.inventoryItemMaterials.edit', function ($trail, InventoryItem $inventoryItem, InventoryItemMaterial $inventoryItemMaterial) {
    $trail->parent('inventory.inventoryItems.show', $inventoryItem);
    $trail->push("Update Material - " . $inventoryItemMaterial->materialItem->name, route('inventory.inventoryItems.inventoryItemMaterials.edit', ['inventoryItem' => $inventoryItem, 'inventoryItemMaterial' => $inventoryItemMaterial]));
});

//inventorCategory

Breadcrumbs::for('inventory.inventoryCategories.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Inventory Categories', route('inventory.inventoryCategories.index'));
});

Breadcrumbs::for('inventory.inventoryCategories.create', function ($trail) {
    $trail->parent('inventory.inventoryCategories.index');
    $trail->push('Create', route('inventory.inventoryCategories.create'));
});

Breadcrumbs::for('inventory.inventoryCategories.edit', function ($trail, InventoryCategory $inventoryCategories) {
    $trail->parent('inventory.inventoryCategories.index');
    $trail->push('Edit', route('inventory.inventoryCategories.edit', ['inventoryCategory' => $inventoryCategories]));
});

Breadcrumbs::for('inventory.inventoryCategories.show', function ($trail, InventoryCategory $inventoryCategory) {
    $trail->parent('inventory.inventoryCategories.index');
    $trail->push($inventoryCategory->code, route('inventory.inventoryCategories.show', ['inventoryCategory' => $inventoryCategory]));
});

///users

Breadcrumbs::for('config.users.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Users', route('config.users.index'));
});

Breadcrumbs::for('config.users.create', function ($trail) {
    $trail->parent('config.users.index');
    $trail->push('Create', route('config.users.create'));
});

Breadcrumbs::for('config.users.edit', function ($trail, User $user) {
    $trail->parent('config.users.index');
    $trail->push('Edit', route('config.users.edit', ['user' => $user]));
});
Breadcrumbs::for('config.users.show', function ($trail, User $user) {
    $trail->parent('config.users.index');
    $trail->push($user->name, route('config.users.show', ['user' => $user]));
});

///roles

Breadcrumbs::for('config.roles.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Roles', route('config.roles.index'));
});

Breadcrumbs::for('config.roles.create', function ($trail) {
    $trail->parent('config.roles.index');
    $trail->push('Create', route('config.roles.create'));
});

Breadcrumbs::for('config.roles.edit', function ($trail, Role $role) {
    $trail->parent('config.roles.index');
    $trail->push('Edit', route('config.roles.edit', ['role' => $role]));
});
Breadcrumbs::for('config.roles.show', function ($trail, Role $role) {
    $trail->parent('config.roles.index');
    $trail->push($role->name, route('config.roles.show', ['role' => $role]));
});
//

//units
Breadcrumbs::for('config.units.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Units', route('config.units.index'));
});

Breadcrumbs::for('config.units.create', function ($trail) {
    $trail->parent('config.units.index');
    $trail->push('Create', route('config.units.create'));
});

Breadcrumbs::for('config.units.edit', function ($trail, Unit $unit) {
    $trail->parent('config.units.index');
    $trail->push('Edit', route('config.units.edit', ['unit' => $unit]));
});
Breadcrumbs::for('config.units.show', function ($trail, Unit $unit) {
    $trail->parent('config.units.index');
    $trail->push($unit->name, route('config.units.show', ['unit' => $unit]));
});

//unitTypes
Breadcrumbs::for('config.unitTypes.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Unit Type', route('config.unitTypes.index'));
});

Breadcrumbs::for('config.unitTypes.create', function ($trail) {
    $trail->parent('config.unitTypes.index');
    $trail->push('Create', route('config.unitTypes.create'));
});

Breadcrumbs::for('config.unitTypes.edit', function ($trail, UnitType $unitType) {
    $trail->parent('config.unitTypes.index');
    $trail->push('Edit', route('config.unitTypes.edit', ['unitType' => $unitType]));
});
Breadcrumbs::for('config.unitTypes.show', function ($trail, UnitType $unitType) {
    $trail->parent('config.unitTypes.index');
    $trail->push($unitType->name, route('config.unitTypes.show', ['unitType' => $unitType]));
});

///inventoryWarehouses

Breadcrumbs::for('inventory.inventoryWarehouses.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Inventory Warehouse', route('inventory.inventoryWarehouses.index'));
});

Breadcrumbs::for('inventory.inventoryWarehouses.create', function ($trail) {
    $trail->parent('inventory.inventoryWarehouses.index');
    $trail->push('Create', route('inventory.inventoryWarehouses.create'));
});

Breadcrumbs::for('inventory.inventoryWarehouses.edit', function ($trail, InventoryWarehouse $inventoryWarehouse) {
    $trail->parent('inventory.inventoryWarehouses.index');
    $trail->push('Edit', route('inventory.inventoryWarehouses.edit', ['inventoryWarehouse' => $inventoryWarehouse]));
});

// sales
Breadcrumbs::for('sale.sales.index', function ($trail) {
    $trail->parent("home");
    $trail->push('Sales', route('sale.sales.index'));
});

Breadcrumbs::for('sale.sales.create', function ($trail) {
    $trail->parent("sale.sales.index");
    $trail->push('Record Sale', route('sale.sales.create'));
});

Breadcrumbs::for('sale.sales.show', function ($trail, Sale $sale) {
    $trail->parent("sale.sales.index");
    $trail->push($sale->code, route('sale.sales.show', ['sale' => $sale]));
});

Breadcrumbs::for('sale.sales.edit', function ($trail, Sale $sale) {
    $trail->parent("sale.sales.show", $sale);
    $trail->push("Update Sale", route('sale.sales.edit', ['sale' => $sale]));
});

// Manufacturing
Breadcrumbs::for('inventory.manufacturings.index', function ($trail) {
    $trail->parent("home");
    $trail->push('Manufacturings', route('inventory.manufacturings.index'));
});

Breadcrumbs::for('inventory.manufacturings.create', function ($trail) {
    $trail->parent("inventory.manufacturings.index");
    $trail->push('New Manufacturing', route('inventory.manufacturings.create'));
});

Breadcrumbs::for('inventory.manufacturings.show', function ($trail, Manufacturing $manufacturing) {
    $trail->parent("inventory.manufacturings.index");
    $trail->push($manufacturing->item->name . ' M' . str_pad($manufacturing->id, 3, "0", STR_PAD_LEFT), route('inventory.manufacturings.show', ['manufacturing' => $manufacturing]));
});

Breadcrumbs::for('inventory.manufacturings.edit', function ($trail,  Manufacturing $manufacturing) {
    $trail->parent("inventory.manufacturings.show", $manufacturing);
    $trail->push('Update', route('inventory.manufacturings.edit', ['manufacturing' => $manufacturing]));
});