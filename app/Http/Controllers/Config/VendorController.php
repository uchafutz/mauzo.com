<?php

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use App\Models\Vendor\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Vendor::class, 'vendor');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::all();
        return view("resources.vendors.index", compact("vendors"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("resources.vendors.form");
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
            "name" => ['required', 'unique:vendors,name'],
            "type" => ['required']
        ]);
        
        Vendor::create($request->input());
        return redirect(route("vendor.vendors.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        return view("resources.vendors.show", compact("vendor"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        return view("resources.vendors.form", compact("vendor"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendor\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        // dd($vendor);

        $request->validate([
            "name" => ['required'],
            "type" => ["required"]
        ]);
        $vendor->update($request->input());
        return redirect(route("vendor.vendors.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return redirect(route("vendor.vendors.index"));
    }
}
