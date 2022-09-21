<?php

namespace App\Models\Inventory;

use App\Models\Config\Unit;
use App\Models\Config\UnitType;
use App\Models\Inventory\InventoryCategory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class InventoryItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'name','description','inventory_category_id','unit_type_id',
        'is_manufactured',
        'is_material',
        'is_product',
        'default_unit_id',
        'reorder_level',
        'featured_image'
    ];

    public function inventoryCategory(){
        return $this->belongsTo(InventoryCategory::class,'inventory_category_id');
    }
    public function unitType(){
        return $this->belongsTo(UnitType::class,'unit_type_id');
    }
    public function unit(){
        return $this->belongsTo(Unit::class ,"default_unit_id");
    }
    protected function featuredImage(): Attribute {
        return Attribute::make(fn ($val) => Storage::url($val));
    }
    public function materials(){
        return $this->hasMany(InventoryItemMaterial::class, "source_inv_items_id");
    }

    public function stockItems() {
        return $this->hasMany(InventoryStockItem::class, "inv_item_id");
    }

    public function calculateInStock() {
        $in_stock = $this->stockItems->reduce(function ($carry, $stockItem) {
            return $carry + $stockItem->in_stock;
        }, 0);
        return $in_stock;
    }

    public function updateInStock() {
        $this->in_stock = $this->calculateInStock();
        $this->save();
    }
}
