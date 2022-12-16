<?php

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use App\Models\Config\Vat;
use Illuminate\Http\Request;

class VatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vats = Vat::all();
        if (request()->wantsJson()) {
            return response()->json($vats);
        }
        return view('resources.config.vats.index', compact('vats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('resources.config.vats.form');
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
            "vat_number" => ["required"],

        ]);
        $vat = Vat::create($request->input());
        if (request()->wantsJson()) {
            return response([
                "data" => $vat
            ], 201);
        }

        return redirect(route("config.vats.index"));
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Config\Vat  $vat
     * @return \Illuminate\Http\Response
     */
    public function show(Vat $vat)
    {
        if (request()->wantsJson()) {
            return response([
                "data" => $vat
            ], 200);
        }
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Config\Vat  $vat
     * @return \Illuminate\Http\Response
     */
    public function edit(Vat $vat)
    {
        return view('resources.config.vats.form', compact('vat'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Config\Vat  $vat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vat $vat)
    {
        $vat->update($request->input());
        if (request()->wantsJson()) {
            return response([
                "data" => $vat
            ], 200);
        }
        return redirect(route("config.vats.index"));
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Config\Vat  $vat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vat $vat)
    {
        $vat->delete();
        if (request()->wantsJson()) {
            return response(null, 204);
        }
        return redirect(route("config.vats.index"));
        //
    }
}