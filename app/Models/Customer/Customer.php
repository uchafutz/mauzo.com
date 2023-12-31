<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'email', 'address', 'phone', 'bus_name', 'bus_address', 'bus_phone', 'bus_tin', 'bus_vrn'];
}