<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[
        'parent_id',
        'name',
        'description',
        'featured_image'
    ];

    public function parent() {
        return $this->belongsTo(InventoryCategory::class, "parent_id");
    }

    public function children() {
        return $this->hasMany(InventoryCategory::class, "parent_id");
    }
}
