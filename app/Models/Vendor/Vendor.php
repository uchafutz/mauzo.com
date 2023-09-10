<?php

namespace App\Models\Vendor;

use App\Models\Purchase\Purchase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];
    public function purchases()
    {
        return $this->belongsToMany(Purchase::class);
    }
}
