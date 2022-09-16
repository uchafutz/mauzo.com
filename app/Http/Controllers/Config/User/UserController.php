<?php

namespace App\Http\Controllers\Config\User;

use App\Events\UserCreated;
use App\Http\Controllers\Controller;
use App\Models\Config\Role;
use App\Models\Config\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Nette\Utils\Random;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        if(request()->wantsJson()){
            return response([
                "data"=>$users
            ],200);
        }
        return view("resources.config.users.index",compact("users"));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view("resources.config.users.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=>["required"],
            "email"=>["required","unique:users,email"],   
        ]);
        $data=[];
        $data["name"]=$request->name;
        $data["email"]=$request->email;
        $data["password"]=Random::generate();
        $user=User::create($data);

        UserCreated::dispatch($user);
        
        if(request()->wantsJson()){
            return response([
                "data"=>$user
            ],201);
        }

       return redirect(route("config.users.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $roles=Role::all();
        $permissions=Permission::all();
        if(request()->wantsJson()){
            return response([
                "data"=>$user
            ],200);
        }
        return view("resources.config.users.show",compact("user","roles","permissions"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //

        return view("resources.config.users.form",compact("user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->input());
        if(request()->wantsJson()){
            return response([
                "data"=>$user
            ],200);
        }
        return redirect(route("config.users.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        if(request()->wantsJson()){
            return response(null,204);
        }
        return redirect(route("config.users.index"));
    }
}
