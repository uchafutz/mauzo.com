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

   public function user_has_permission(){
    return $this->belongsToMany(User::class,'users_has_permissions','permission_id','user_id');
   }

   public function role_hase_permission(){
    return $this->belongsToMany(Permission::class,'roles_has_permissions','role_id','permission_id');
   }

}
