<?php

namespace App\Models\Config;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[
        'name','description','code','symbol','unit_type_id','factor'
    ];

    public function unitType(){
        return $this->belongsTo(UnitType::class);
    }
}
