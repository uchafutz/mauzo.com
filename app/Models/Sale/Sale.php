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

    protected $fillable=['code','date','description','customer_id','total_amount','recieved_amount','return_amount'];

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
