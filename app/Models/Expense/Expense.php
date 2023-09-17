<?php

namespace App\Models\Expense;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = ['expense_category_id', 'description', 'amount', 'user_id', 'type'];

    public function expenseCategory(){
        return $this->belongsTo(ExpenseCategory::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
