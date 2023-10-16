<?php

namespace App\Models\Expense;

use App\Models\Inventory\InventoryWarehouse;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = ['expense_category_id', 'description', 'amount', 'user_id', 'type', 'inventory_warehouse_id'];

    public function expenseCategory(){
        return $this->belongsTo(ExpenseCategory::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function inventoryWarehouse(){
        return $this->belongsTo(InventoryWarehouse::class);
    }
}
