<?php

namespace App\Models\Config;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Organization extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address', 'phone', 'descripction', 'featured_image'];
    
    protected function featuredImage(): Attribute
    {
        return Attribute::make(fn ($val) => Storage::url($val));
    }
}