<?php

namespace App\Models\Inventory;

use App\Models\Expense\Expense;
use App\Models\User;
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

    protected function featuredImage(): Attribute
    {
        return Attribute::make(fn ($val) => Storage::url($val));
    }

    public function items()
    {
        return $this->belongsToMany(InventoryItem::class, "warehouse_has_items", "inv_warehouse_id", "inv_item_id")->withPivot(["in_stock"]);
    }

    public function findItem(InventoryItem $item)
    {
        $item = $this->items()->where("inv_item_id", $item->id)->first();
        return $item;
    }

    public function updateItemInstock(InventoryItem $item, $in_stock)
    {
        $warehouseItem = $this->findItem($item);
        if (!$warehouseItem) {
            // Create Warehouse item
            $this->items()->attach($item->id, ["in_stock" => $in_stock]);
        } else {
            $this->items()->sync([$item->id => ["in_stock" => $in_stock]], false);
        }
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function expenses(){
        return $this->hasMany(Expense::class);
    }
}
