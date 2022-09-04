@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add inventoryCategory') }}</div>

                    <div class="card-body">
                       
                        @isset($inventoryCategory)
                            <form action="{{ route("inventory.inventoryCategories.update", ["inventoryCategory" => $inventoryCategory]) }}" method="POST" enctype="multipart/form-data">
                                @method("patch")
                        @else
                            <form action="{{ route("inventory.inventoryCategories.store") }}" method="POST" enctype="multipart/form-data">
                        @endisset
                        
                            @csrf
                               
                               <x-form.custom-input name="name" type="text" label="Name" placeholder="Enter name" value="{{ old('name')  }}"/>
                               <x-form.custom-input type="file" name="featured_image" label="Featured Image" placeholder="Import file" />

                               <x-form.custom-textarea name="description" label="Description" placeholder="Description" value="{{old('description')}}"/>
                               <br/>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection