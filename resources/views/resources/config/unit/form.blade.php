@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Unit') }}</div>

                    <div class="card-body">
                       
                        @isset($unit)
                            <form action="{{ route("config.units.update", ["unit" => $unit]) }}" method="POST" enctype="multipart/form-data">
                                @method("patch")
                        @else
                            <form action="{{ route("config.units.store") }}" method="POST" enctype="multipart/form-data">
                        @endisset
                        
                            @csrf

                            <x-form.custom-input name="name" type="text" label="Name Unit" placeholder="Unit name" value="{{ old('name')}}"/>
                            <div class="form-group">
                                <label for="" class="label-control">Unit Type</label>
                                <select name="unit_type_id"  class="form-control @error('unit_type_id') is-invalid @enderror">
                                    @foreach($unitTypes as $unitType)
                                    <option value="{{ old('unit_type_id')??(isset($unitType->id) ? $unitType->id:"")}}">{{ $unitType->name }}</option>
                                    @endforeach
                                </select>
                                @error('unit_types')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <x-form.custom-input name="code" type="text" label="Code" placeholder="Code" value="{{ old('code') }}"/>
                            <x-form.custom-textarea name="description" label="Description" placeholder="Description" value="{{old('description')}}"/>
                            <x-form.custom-input name="symbol" type="text" label="Symbol" placeholder="Symbol" value="{{ old('symbol')  }}"/>
                            <x-form.custom-input name="factor" type="text" label="Factor" placeholder="Factor" value="{{ old('factor') }}"/>

                            <br/>
                           

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection