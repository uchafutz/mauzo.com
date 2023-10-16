<?php

namespace App\Http\Controllers\Config\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AssignUserPermissionController extends Controller
{
    
    public function __invoke(Request $request, User $user)
    {
        //
        $user->permissions()->sync($request->input("permission_id"));
        return redirect(route("config.users.show", ["user" => $user]));
    }
}
