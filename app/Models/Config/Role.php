<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        "name",
        "display",
        "description"
    ];
   
    public function role_has_permission(){
        return $this->belongsToMany(Permission::class,'roles_has_permissions','role_id','permission_id');
    }

    public function user_has_role(){
        return $this->belongsToMany(User::class,'users_has_roles','role_id','user_id');
    }
    
}
