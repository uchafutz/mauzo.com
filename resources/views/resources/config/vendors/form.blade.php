@extends('layouts.app')
@section('page_title')
    @isset($vendor)
        Update Vendor
    @else
        New Vendor
    @endisset
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>

                    <div class="card-body">

                        @isset($vendor)
                            <form action="{{ route('config.vendors.update', ['vendor' => $vendor]) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('patch')
                            @else
                                <form action="{{ route('config.vendors.store') }}" method="POST" enctype="multipart/form-data">
                                @endisset

                                @csrf

                                <x-form.custom-input name="name" type="text" label="Name Vendor" placeholder="Vendor name"
                                    value="{{ isset($vendor) ? $vendor->name : null }}" />
                           
                                <x-form.custom-textarea name="description" label="Description" placeholder="Description"
                                    value="{{ isset($vendor) ? $vendor->description : null }}" />
                              
                               

                                <br />


                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
