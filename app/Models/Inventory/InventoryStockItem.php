<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryStockItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'inv_item_id',
        'source_id',
        'source_type',
        'inv_warehouse_id',
        'quantity',
        'unit_cost',
        'in_stock'
    ];

    public function source(){
        return $this->morphTo();
    }

    public function warehouse(){
        return $this->belongsTo(InventoryWarehouse::class,'inv_warehouse_id');
    }

    public function item(){
        return $this->belongsTo(InventoryItem::class,"inv_item_id");
    }

    public function stockReceived() {
        return $this->morphMany(InventoryStockTransaction::class, "destination");
    }

    public function stockTransfered() {
        return $this->morphMany(InventoryStockTransaction::class, "source");
    }

    public function manufacturingMaterials() {
        return $this->belongsToMany(ManufacturingMaterial::class, "manufacturing_material_stock_items")->withPivot("quantity");
    }
}
