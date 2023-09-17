<?php

namespace App\Models\Inventory;

use App\Models\Config\Unit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manufacturing extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["inventory_item_id", "config_unit_id", "quantity", "status", "warehouse_id", 'user_id'];

    public function item()
    {
        return $this->belongsTo(InventoryItem::class, "inventory_item_id");
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, "config_unit_id");
    }

    public function materials()
    {
        return $this->hasMany(ManufacturingMaterial::class, "manufacturing_id");
    }

    public function warehouse()
    {
        return $this->belongsTo(InventoryWarehouse::class, "warehouse_id");
    }

    public function stockItems()
    {
        return $this->morphMany(InventoryStockItem::class, 'source');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}