<?php

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use App\Models\Config\Permission;
use App\Models\Config\Role;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles=Role::all();
        if(request()->wantsJson()){
            return response([
                "data"=>$roles
            ],200);
      
        }
        return view("resources.config.roles.index",compact("roles"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // Log::info("create method triggred from Role controller", ["debug" => "values"]);
        return view("resources.config.roles.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->input());
        $request->validate([
            "name"=>["required","unique:roles,name"],
            "display"=>["required"],
        ]);
        $role=Role::create($request->input());
        if(request()->wantsJson()){
            return response([
                "data"=>$role
            ],201);
        }
        return redirect(route("config.roles.index"));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Config\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $permissions=Permission::all();
        
        if(request()->wantsJson()){
            return response([
                "data"=>$role
            ],200);
        }
        
        return view("resources.config.roles.show",compact("role","permissions"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Config\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
        return view("resources.config.roles.form",compact("role"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Config\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $role->update($request->input());
        if(request()->wantsJson()){
            return response([
                "data"=>$role
            ],200);
        }
        return redirect(route("config.roles.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Config\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        
        $role->delete();
        if(request()->wantsJson()){
            return response(null,204);
        }
        return redirect(route("config.roles.index"));
    }
}
