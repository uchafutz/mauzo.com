<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryStockTransaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'source_id',
        'source_type',
        'destination_id',
        'destination_type',
        'inv_item_id',
        'quantity'
    ];

    public function source()
    {
        return $this->morphTo();
    }

    public function destination()
    {
        return $this->morphTo();
    }

    public function item()
    {
        return $this->belongsTo(InventoryItem::class);
    }
}