<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryItemMaterial extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[ "source_inv_items_id","material_inv_items_id","quantity","type"];

    public function sourceItem() {
        return $this->belongsTo(InventoryItem::class,'source_inv_items_id');
    }

    public function materialItem(){
        return $this->belongsTo(InventoryItem::class,'material_inv_items_id');
    }
}
