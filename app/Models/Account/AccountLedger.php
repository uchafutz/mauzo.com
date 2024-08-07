<?php

namespace App\Models\Account;

use App\Models\Sale\Sale;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountLedger extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=["account_id","description", "amount","credit","debit","date","sale_id","user_id"];
    protected $date=["created_at"];

    public function account(){
        return $this->belongsTo(Account::class, "account_id");
    }

    public function sale(){
        return $this->belongsTo(Sale::class,'sale_id');
    }

    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }
}
