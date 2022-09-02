<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class InventoryWarehouse extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["name", "description", "featured_image"];

    protected function featuredImage(): Attribute {
        return Attribute::make(fn ($val) => Storage::url($val));
    }
}
