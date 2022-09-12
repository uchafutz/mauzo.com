<?php

namespace App\Models\Purchase;

use App\Models\Config\Unit;
use App\Models\Config\UnitType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseItems extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['inv_items_id','conf_unit_types_id','conf_units_id','purchases_id','amount','quantity'];

    public function inventoryItem(){
        return $this->belongsTo(inventoryItems::class,'inv_items_id');
    }

    public function unitType(){
        return $this->belongsTo(UnitType::class,'conf_unit_types_id');
    }

    public function unit(){
        return $this->belongsTo(Unit::class,'conf_units_id');
    }

    public function purchase(){
        return $this->belongsTo(Purchase::class,'purchases_id');
    }


}
