<?php

namespace App\Models\Purchase;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['code', 'date', 'description', 'status', 'submited_at', 'warehouse_id', 'user_id'];
    protected $dates = ["date"];

    public static function boot()
    {
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

    public function items()
    {
        return $this->hasMany(PurchaseItems::class, 'purchase_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // @TODO: when generate stock items logic needs to be reused for a purchase
    public function generateStockItems()
    {
        // loop through the items
    }
}