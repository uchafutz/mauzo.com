<?php

namespace App\Models\Stock;

use App\Models\Inventory\InventoryWarehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockTransfer extends Model
{

    use HasFactory;
    use SoftDeletes;
    protected $dates = ['date'];
    protected $fillable = ['code', 'description', 'date', 'from_warehouse_id', 'to_warehouse_id', 'operation_id', 'status'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $latest = StockTransfer::latest()->first();
            $phrase = "STOCK";
            // dd($latest);
            if (!$latest) {
                $model->code = $phrase . '-' . 1;
            } else {
                $arr = explode("-", $latest->code);
                $model->code = $phrase . '-' . ($arr[1] + 1);
            }
        });
    }

    public function inventoryfrom()
    {
        return $this->hasMany(InventoryWarehouse::class, 'from_warehouse_id');
    }

    public function inventoryto()
    {
        return $this->hasMany(InventoryWarehouse::class, 'to_warehouse_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'operation_id');
    }
    public function items()
    {
        return $this->hasMany(StockTransferItem::class, 'stock_transfer_id');
    }
}