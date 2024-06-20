<?php

namespace App\Models\Account;

use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ["date"];

    protected $fillable=["account_name","status","balance","account_type","initial_balance","account_owner"];

    public function customer(){
        return $this->belongsTo(Customer::class,'account_owner');
        }

    public function ledgers(){
        return $this->hasMany(AccountLedger::class,"account_id");
    }
}
