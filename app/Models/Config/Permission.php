<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $fillable = ["name", "display", "description"];

   public function users(){
    return $this->belongsToMany(User::class,'users_has_permissions','permission_id','user_id');
   }

   public function roles(){
    return $this->belongsToMany(Role::class,'roles_has_permissions','permission_id', 'role_id');
   }

}
