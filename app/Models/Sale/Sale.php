<?php

namespace App\Models\Sale;

use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['code','date','description','customer_id','total_amount','received_amount','return_amount'];
    protected $dates = ["date"];

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public static function boot() {
        parent::boot();
        static::creating(function ($model) {
            $latest = Sale::latest()->first();
            $phrase = "SEL";
            // dd($latest);
            if (!$latest) {
                $model->code = $phrase . '-' . 1;
            } else {
                $arr = explode("-", $latest->code);
                $model->code = $phrase . '-' . ($arr[1] + 1);
            }
        });
    }

    public function salesItems(){
        return $this->hasMany(SaleItem::class,'sale_id');
    }
}
