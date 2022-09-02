<?php

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use App\Models\Config\Unit;
use App\Models\Config\UnitType;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units=Unit::all();
        if(request()->wantsJson()){
            return response([
                'data'=>$units,

            ],200);
        }
        return view("resources.config.unit.index",['units'=>$units]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
    $unitTypes=UnitType::all();
     return view("resources.config.unit.form",compact("unitTypes"));
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
            "name"=>["required","unique:units,name"],
            "code"=>["required","unique:units,code"],
            "unit_type_id"=>"required"

        ]);
     
       $units=Unit::create($request->input());
       if(request()->wantsJson()){
        return response([
            "data"=>$units
        ],201);
       }
        
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
        if(request()->wantsJson()){
            return response([
                "data"=>$unit
            ],200);
        }
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
        $unitTypes=UnitType::all();
        return view("resources.config.unit.form", compact('unitTypes', 'unit'));
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
        $unit->update($request->input());
        if(request()->wantsJson()){
            return response([
                "data"=>$unit
            ],200);
        }
        return redirect(route("config.units.index"));
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
        return redirect(route("config.units.index"));
    }
}
