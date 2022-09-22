<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class InventoryWarehouse extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["name", "description", "featured_image"];

    protected function featuredImage(): Attribute {
        return Attribute::make(fn ($val) => Storage::url($val));
    }

    public function items() {
        return $this->belongsToMany(InventoryItem::class, "warehouse_has_items", "inv_warehouse_id", "inv_item_id")->withPivot(["in_stock"]);
    }

    public function findItem(InventoryItem $item) {
        $item = $this->items()->where("inv_item_id", $item->id)->first();
        return $item;
    }
}
