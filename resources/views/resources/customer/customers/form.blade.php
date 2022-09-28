@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Add Customer') }}</div>

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

                                <x-form.custom-input name="name" type="text" label="Name" placeholder="Enter name"
                                    value="{{ isset($customer) ? $customer->name : null }}" />
                                <x-form.custom-input name="address" type="text" label="Address"
                                    placeholder="Enter Address"
                                    value="{{ isset($customer) ? $customer->address : null }}" />
                                <x-form.custom-input name="email" type="text" label="Email" placeholder="Enter Email"
                                    value="{{ isset($customer) ? $customer->email : null }}" />
                                <x-form.custom-input name="phone" type="text" label="phone" placeholder="Enter Phone"
                                    value="{{ isset($customer) ? $customer->phone : null }}" />

                                <br />

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
