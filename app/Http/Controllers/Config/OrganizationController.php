<?php

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Utility;
use App\Models\Config\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organizations = Organization::all();
        if (request()->wantsJson()) {
            return response([
                "data" => $organizations
            ], 200);
        }
        return view('resources.config.organizations.index', compact('organizations'));

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('resources.config.organizations.create');
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
            "name" => ["required", "unique:organizations,name"],

        ]);
        $organization = new Organization();
        $organization->fill($request->input());
        if ($request->hasFile("featured_image")) {
            $organization->featured_image = Utility::uploadFile("featured_image");
        }
        $organization->save();
        if (request()->wantsJson()) {
            return response([
                "data" => $organization
            ], 201);
        }
        return redirect(route("config.organizations.index"));
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Config\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        if (request()->wantsJson()) {
            return response([
                "data" => $organization
            ], 200);
        }
        return view("resources.config.organizations.show", compact("organization"));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Config\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        return view("resources.config.organizations.create", compact("organization"));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Config\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
    {
        $organization->fill($request->input());
        if ($request->hasFile("featured_image")) {
            $organization->featured_image = Utility::uploadFile("featured_image");
        }
        $organization->update();
        if (request()->wantsJson()) {
            return response([
                "data" => $organization
            ], 200);
        }
        return redirect(route("config.organizations.index"));
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Config\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        $organization->delete();
        if (request()->wantsJson()) {
            return response(null, 204);
        }
        return redirect(route("config.organizations.index"));
        //
    }
}