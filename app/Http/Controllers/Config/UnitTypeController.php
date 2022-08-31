<?php

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use App\Models\Config\UnitType;
use Illuminate\Http\Request;

class UnitTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $unitTypes = UnitType::all();

        // FOR API
        if (request()->wantsJson()) {
            return response([
                "data" => $unitTypes,
            ], 200);
        }

        return view("resources.config.unit_types.index", compact("unitTypes"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("resources.config.unit_types.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "name" => ["required", "unique:unit_types,name"]
        ]);

        $unitType = UnitType::create($request->input());

        if (request()->wantsJson()) {
            return response([
                "data" => $unitType,
            ], 201);
        }

        return redirect(route("config.unitTypes.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Config\UnitType  $unitType
     * @return \Illuminate\Http\Response
     */
    public function show(UnitType $unitType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Config\UnitType  $unitType
     * @return \Illuminate\Http\Response
     */
    public function edit(UnitType $unitType)
    {
        //
        return view("resources.config.unit_types.form", compact("unitType"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Config\UnitType  $unitType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UnitType $unitType)
    {
        //
         //
         $request->validate([
            "name" => ["required"]
        ]);

        $unitType->update($request->input());

        if (request()->wantsJson()) {
            return response([
                "data" => $unitType,
            ], 200);
        }

        return redirect(route("config.unitTypes.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Config\UnitType  $unitType
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnitType $unitType)
    {
        //
        $unitType->delete();

        if (request()->wantsJson()) {
            return response(null, 204);
        }

        return redirect(route("config.unitTypes.index"));
    }
}
