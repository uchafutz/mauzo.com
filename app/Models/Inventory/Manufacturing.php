<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manufacturing extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["inventory_item_id", "config_unit_id", "quantity", "status"];
}
