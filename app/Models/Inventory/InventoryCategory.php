<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class InventoryCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'parent_id',
        'name',
        'description',
        'featured_image'
    ];

    public function parent()
    {
        return $this->belongsTo(InventoryCategory::class, "parent_id");
    }

    public function children()
    {
        return $this->hasMany(InventoryCategory::class, "parent_id");
    }

    protected function featuredImage(): Attribute
    {
        return Attribute::make(fn ($val) => Storage::url($val));
    }
}