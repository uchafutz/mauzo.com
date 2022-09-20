<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['code','date','description', 'status'];
    protected $dates = ["date"];

    public static function boot() {
        parent::boot();
        static::creating(function ($model) {
            $latest = Purchase::latest()->first();
            $phrase = "PUR";
            // dd($latest);
            if (!$latest) {
                $model->code = $phrase . '-' . 1;
            } else {
                $arr = explode("-", $latest->code);
                $model->code = $phrase . '-' . ($arr[1] + 1);
            }
        });
    }

    public function items(){
        return $this->hasMany(PurchaseItems::class,'purchase_id');
    }
}
