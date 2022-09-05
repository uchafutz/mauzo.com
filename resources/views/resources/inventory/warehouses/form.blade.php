@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Inventory Warehouse Form') }}</div>

                    <div class="card-body">
                       
                        @isset($inventoryWarehouse)
                            <form action="{{ route("inventory.inventoryWarehouses.update", ["inventoryWarehouse" => $inventoryWarehouse]) }}" method="POST" enctype="multipart/form-data">
                                @method("patch")
                        @else
                            <form action="{{ route("inventory.inventoryWarehouses.store") }}" method="POST" enctype="multipart/form-data">
                        @endisset
                        
                            @csrf
                            <x-form.custominput type="file" name="featured_image" label="Featured Image" placeholder="Enter name" />
                            <x-form.custominput type="text" name="name" label="Warehouse Name" placeholder="Enter the name of the warehouse" value=" {{ isset($inventoryWarehouse)?$inventoryWarehouse->name : null }}" />
                            <x-form.custom-textarea name="description" label="Description" placeholder="Description" value="{{ isset($inventoryWarehouse) ? $inventoryWarehouse->description : null }}" />
                            <br/>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection