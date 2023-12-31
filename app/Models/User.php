<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Config\Permission;
use App\Models\Config\Role;
use App\Models\Expense\Expense;
use App\Models\Inventory\InventoryWarehouse;
use App\Models\Inventory\Manufacturing;
use App\Models\Purchase\Purchase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'is_admin',
        'inventory_warehouse_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_has_roles', 'user_id', 'role_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_has_permissions', 'user_id', 'permission_id');
    }

    public function sales()
    {
        return $this->hasMany(Sales::class, 'user_id');
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'user_id');
    }

    public function manufacturings()
    {
        return $this->hasMany(Manufacturing::class, 'user_id');
    }

    public function inventoryWarehouse(){
        return $this->belongsTo(InventoryWarehouse::class);
    }

    public function expenses(){
        return $this->hasMany(Expense::class);
    }
}