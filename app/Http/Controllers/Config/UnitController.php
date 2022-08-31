<?php

namespace App\Http\Controllers;

use App\Models\Config\UnitModel;
use Illuminate\Http\Request;
use  App\Models\Config\UnitType;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unit=UnitModel::all();
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
     return view("resources.config.unit.from",compact("unitType"));
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
        $unit=UnitModel::create($request->input());
        return view("resources.config.unit.index");

        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Config\UnitModel  $unitModel
     * @return \Illuminate\Http\Response
     */
    public function show(UnitModel $unitModel)
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Config\UnitModel  $unitModel
     * @return \Illuminate\Http\Response
     */
    public function edit(UnitModel $unitModel)
    {
    
        return view("resources.config.unit.from",compact("unitModel"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Config\UnitModel  $unitModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UnitModel $unitModel)
    {
        $request->validate([
            "name"=>["required","unique:unit,name"],
            "description"=>"required | max:45",
            "code"=>["required","unique:unit,code"],
            "unit_type"=>"required"

        ]);

        $unitModel->update($request->input());
        if(request()->wantsJson()){
            return response([
                "data"=>$unitModel
            ],200);
        }
        return redirect(route("resources.config.unit.index"));
        
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Config\UnitModel  $unitModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnitModel $unitModel)
    {
        $unitModel->delete();
        if(request()->wantsJson()){
            return response(null,204);
        }
        return redirect(route("resources.config.unit.index"));

        //
    }
    
}
