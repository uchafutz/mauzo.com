<?php

namespace App\Models\Inventory;

use App\Models\Config\UnitType;
use App\Models\Inventory\InventoryCategory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class InventoryItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'name','description',
    ];

    public function inventoryCategory(){
        return $this->belongsTo(InventoryCategory::class,'inventory_category_id');
    }
    public function unitType(){
        return $this->belongsTo(UnitType::class,'unit_type_id');
    }
    protected function featuredImage(): Attribute {
        return Attribute::make(fn ($val) => Storage::url($val));
    }
}
