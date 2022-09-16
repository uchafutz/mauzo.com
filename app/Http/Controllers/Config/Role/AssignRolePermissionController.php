<?php

namespace App\Http\Controllers\Config\Role;

use App\Http\Controllers\Controller;
use App\Models\Config\Role;
use Illuminate\Http\Request;

class AssignRolePermissionController extends Controller
{
    public function __invoke(Request $request, Role $role)
    {
       // dd($request->all());
        $role->permissions()->sync($request->input("permission_id"));
        return redirect(route("config.roles.show", ["role" => $role]));
    }
}
