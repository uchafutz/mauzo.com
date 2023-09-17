<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vat extends Model
{
    use HasFactory;
    protected $table = 'vats';

    protected $fillable = ['name', 'vat_number'];
}