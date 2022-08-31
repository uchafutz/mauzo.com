<?php

namespace App\Http\Controllers\Config;

use App\Models\Config\Unit;
use App\Models\Config\UnitType;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unit=Unit::all();
        if(request()->wantsJson()){
            return response([
                'data'=>$unit,

            ],200);
        }
        return view("resources.config.unit.index",compact('unit'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
    $unitType=UnitType::all();
     return view("resources.config.unit.form",compact("unitType"));
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
            "name"=>["required","unique:unit,name"],
            "description"=>"required | max:45",
            "code"=>["required","unique:unit,code"],
            "unit_type"=>"required"

        ]);
        $unit=Unit::create($request->input());
        return view("resources.config.unit.index");
        //

       

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Config\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
    
        return view("resources.config.unit.show",compact("unit"));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Config\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        return view("resources.config.unit.form",compact("unit"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Config\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
    
        $request->validate([
            "name"=>["required","unique:unit,name"],
            "description"=>"required | max:45",
            "code"=>["required","unique:unit,code"],
            "unit_type"=>"required"

        ]);
        $unit->update($request->input());
        if(request()->wantsJson()){
            return response([
                "data"=>$unit
            ],200);
        }
        return redirect(route("resources.config.unit.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Config\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
    
        $unit->delete();
        if(request()->wantsJson()){
            return response(null,204);
        }
        return redirect(route("resources.config.unit.index"));
    }
}
