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

                            <div class="form-group">
                                <label for="" class="label-control">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') ?? (isset($unitType) ? $unitType->name : "") }}" />
                            </div>

                            <div class="form-group">
                                <label for="" class="label-control">Description</label>
                                <textarea name="description" class="form-control" placeholder="Description" >{{ old('description') ?? (isset($unitType) ? $unitType->description : "") }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection