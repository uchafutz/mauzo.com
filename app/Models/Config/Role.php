<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        "name",
        "display",
        "description"
    ];
   
    public function permissions(){
        return $this->belongsToMany(Permission::class,'roles_has_permissions','role_id','permission_id');
    }

    public function users(){
        return $this->belongsToMany(User::class,'users_has_roles','role_id','user_id');
    }
    
}
