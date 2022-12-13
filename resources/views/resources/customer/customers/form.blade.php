@extends('layouts.app')
@section('page_title')
    @isset($customer)
        Update Customer
    @else
        New Customer
    @endisset
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"></div>

                    <div class="card-body">

                        @isset($customer)
                            <form action="{{ route('customer.customers.update', ['customer' => $customer]) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('patch')
                            @else
                                <form action="{{ route('customer.customers.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                @endisset

                                @csrf

                                <div class="container">
                                    <div class="col-12">
                                        <h3>Contact Personal</h3>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col">
                                            <x-form.custom-input name="name" type="text" label="Name"
                                                placeholder="Enter name"
                                                value="{{ isset($customer) ? $customer->name : null }}" />
                                        </div>
                                        <div class="col">

                                            <x-form.custom-input name="address" type="text" label="Address"
                                                placeholder="Enter Address"
                                                value="{{ isset($customer) ? $customer->address : null }}" />

                                        </div>
                                        <div class="col">
                                            <x-form.custom-input name="email" type="text" label="Email"
                                                placeholder="Enter Email"
                                                value="{{ isset($customer) ? $customer->email : null }}" />

                                        </div>
                                        <div class="col">
                                            <x-form.custom-input name="phone" type="text" label="phone"
                                                placeholder="Enter Phone"
                                                value="{{ isset($customer) ? $customer->phone : null }}" />
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="col-12">
                                        <h3>Business Contact</h3>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <x-form.custom-input name="bus_name" type="text" label="Business Name"
                                                placeholder="Enter Business Name"
                                                value="{{ isset($customer) ? $customer->bus_name : null }}" />
                                        </div>
                                        <div class="col">
                                            <x-form.custom-input name="bus_address" type="text" label="Business Address"
                                                placeholder="Enter Business Address"
                                                value="{{ isset($customer) ? $customer->bus_address : null }}" />
                                        </div>
                                        <div class="col">
                                            <x-form.custom-input name="bus_phone" type="text" label="Business Phone"
                                                placeholder="Enter Business Phone Number"
                                                value="{{ isset($customer) ? $customer->bus_phone : null }}" />
                                        </div>
                                        <div class="col">
                                            <x-form.custom-input name="bus_tin" type="text" label="TIN No:"
                                                placeholder="Enter Business TIN number"
                                                value="{{ isset($customer) ? $customer->bus_tin : null }}" />
                                        </div>
                                    </div>
                                </div>





                                <br />

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
