<?php

namespace App\Http\Controllers\Customer;

use App\Events\CustomerAccountCreateEvent;
use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers=Customer::all();
        if(request()->wantsJson()){
            return response([
                "data"=>$customers
            ],200);
        }

        return view("resources.customer.customers.index",compact("customers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("resources.customer.customers.form");
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
            "name"=>["required","unique:customers,name"]
        ]);
        $customer=Customer::create($request->input());
        if(request()->wantsJson()){
            return response([
                "data"=>$customer
            ],201);
        }
         CustomerAccountCreateEvent::dispatch($customer);
        return redirect(route("customer.customers.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        if(request()->wantsJson()){
            return response([
                "data"=>$customer
            ],200);
        }
        
        return view("resources.customer.customers.show",compact("customer"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        
        return view("resources.customer.customers.form",compact("customer"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        

        $customer->update($request->input());
        if(request()->wantsJson()){
            return response([
                "data"=>$customer
            ],200);
        }
        return redirect(route("customer.customers.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        if(request()->wantsJson()){
            return response(null,204);
        }
        return redirect(route("customer.customers.index"));
    }
}
