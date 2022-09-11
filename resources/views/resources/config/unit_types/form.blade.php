@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Unit Type') }}</div>

                    <div class="card-body">
                       
                        @isset($unitType)
                            <form action="{{ route("config.unitTypes.update", ["unitType" => $unitType]) }}" method="POST" enctype="multipart/form-data">
                                @method("patch")
                        @else
                            <form action="{{ route("config.unitTypes.store") }}" method="POST" enctype="multipart/form-data">
                        @endisset
                        
                            @csrf
                             
                               <x-form.custom-input name="name" type="text" label="Name" placeholder="Enter name" value="{{ isset($unitType) ? $unitType->name : null }}"/>

                               <x-form.custom-textarea name="description" label="Description" placeholder="Description" value="{{ isset($unitType) ? $unitType->description : null }}"/>
                               <br/>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection