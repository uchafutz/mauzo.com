<?php

namespace App\Models\Stock;

use App\Models\Config\Unit;
use App\Models\Inventory\InventoryItem;
use App\Models\Inventory\InventoryStockItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockTransferItem extends Model

{

    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['stock_transfer_id', 'inv_item_id', 'quantity', 'conf_unit_id'];
    public function inventoryItem()
    {
        return $this->belongsTo(InventoryItem::class, 'inv_item_id');
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'conf_unit_id');
    }

    public function stocktransfer()
    {
        return $this->belongsTo(StockTransfer::class, 'stock_transfer_id');
    }

    public function stockItems()
    {
        return $this->morphMany(InventoryStockItem::class, 'source');
    }
}
