<?php

namespace App\Http\Controllers\Config\User;

use App\Events\UserCreated;
use App\Http\Controllers\Controller;
use App\Models\Config\Role;
use App\Models\Config\Permission;
use App\Models\Inventory\InventoryWarehouse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\Random;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('inventoryWarehouse')->get();
        if (request()->wantsJson()) {
            return response([
                "data" => $users
            ], 200);
        }
        return view("resources.config.users.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $warehouses = InventoryWarehouse::all();

        return view("resources.config.users.form", ['warehouses' => $warehouses]);
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
            "name" => ["required"],
            "email" => ["required", "email", "unique:users,email"],
        ]);
        $password = "password";
        $data = [];
        $data["name"] = $request->name;
        $data["email"] = $request->email;
        $data["is_admin"] = $request->is_admin == 'on' ? 1 : 0;
        $data["password"] = Hash::make("password");
        $data['inventory_warehouse_id'] = $request->inventory_warehouse_id;
        $user = User::create($data);

        UserCreated::dispatch($user);

        if (request()->wantsJson()) {
            return response([
                "data" => $user
            ], 201);
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
        $roles = Role::all();
        $permissions = Permission::all();
        if (request()->wantsJson()) {
            return response([
                "data" => $user
            ], 200);
        }
        return view("resources.config.users.show", compact("user", "roles", "permissions"));
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
        $warehouses = InventoryWarehouse::all();


        return view("resources.config.users.form", compact(["user", "warehouses"]));
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
// dd(intval($request['user_warehouse']));

        $request['is_admin'] = $request['is_admin'] == 'on' ? 1 : 0;
        $request['inventory_warehouse_id'] = intval($request['inventory_warehouse_id']);

        $user->update($request->input());
        if (request()->wantsJson()) {
            return response([
                "data" => $user
            ], 200);
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
        if (request()->wantsJson()) {
            return response(null, 204);
        }
        return redirect(route("config.users.index"));
    }
}
