<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryStockItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'in_item_id',
        'source_id',
        'source_type',
        'inv_warehouse_id',
        'quantity',
        'unit_cost',
        'in_stock'

    ];
}
