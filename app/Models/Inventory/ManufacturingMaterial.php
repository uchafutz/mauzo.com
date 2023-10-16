<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManufacturingMaterial extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["manufacturing_id", "inventory_item_material_id", "quantity", "inventory_stock_item_id"];

    public function manufacturing() {
        return $this->belongsTo(Manufacturing::class, "manufacturing_id");
    }

    public function material() {
        return $this->belongsTo(InventoryItemMaterial::class, "inventory_item_material_id");
    }

    public function stockItems() {
        return $this->belongsToMany(InventoryStockItem::class, "manufacturing_material_stock_items", "manufacturing_material_id", "stock_item_id")->withPivot("quantity");
    }

    // @TODO: WORK ON THE NAMING
    public function stockItemsMorph(){
        return $this->morphMany(InventoryStockItem::class, 'source');
    }
}
