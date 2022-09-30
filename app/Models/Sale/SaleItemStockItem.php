<?php

namespace App\Models\Sale;

use App\Models\Inventory\InventoryStockItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleItemStockItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["sale_item_id", "stock_item_id", "quantity", "stock_item_snapshot"];

    public function saleItem() {
        return $this->belongsTo(SaleItem::class, "sale_item_id");
    }

    public function stockItem() {
        return $this->belongsTo(InventoryStockItem::class, "stock_item_id");
    }

    public function stockItemSnapShot() {
        $stockItem = new InventoryStockItem();
        $stockItem->fill(json_decode($this->stock_item_snapshot));
        return $stockItem;
    }
}
