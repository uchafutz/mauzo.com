<?php

namespace App\Models\Sale;
use App\Models\Config\Unit;
use App\Models\Inventory\InventoryItem;
use App\Models\Inventory\InventoryStockItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['sale_id','inv_item_id','conf_unit_id',"quantity","unit_price"];

    public function sale(){
        return $this->belongsTo(Sale::class,'sale_id');
    }

    public function item(){
        return $this->belongsTo(InventoryItem::class,'inv_item_id');
    }
    
    public function unit(){
        return $this->belongsTo(Unit::class,'conf_unit_id');
    }
    public function stockItems(){
        return $this->hasMany(SaleItemStockItem::class, 'sale_item_id');
    }
}
