<?php

namespace App\Models\Purchase;

use App\Models\Config\Unit;
use App\Models\Config\UnitType;
use App\Models\Inventory\InventoryItem;
use App\Models\Inventory\InventoryStockItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseItems extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['inv_item_id','conf_unit_id','purchase_id','unit_price','quantity'];

    public function inventoryItem(){
        return $this->belongsTo(InventoryItem::class,'inv_item_id');
    }

    public function unit(){
        return $this->belongsTo(Unit::class,'conf_unit_id');
    }

    public function purchase(){
        return $this->belongsTo(Purchase::class,'purchase_id');
    }

    public function stockItems(){
        return $this->morphMany(InventoryStockItem::class,'source');
    }
}
