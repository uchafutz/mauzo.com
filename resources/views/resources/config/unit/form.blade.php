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

                            <div class="form-group">
                                <label for="" class="label-control">Name Unit</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name') ?? (isset($unit) ? $unit->name : "") }}" />
                                @error('name')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="label-control">Unit Type</label>
                                <select name="unit_types"  class="form-control @error('unit_types') is-invalid @enderror">
                                    @foreach($unitType as $unitOpt)
                                    <option value="{{ old('unit_types')??(isset($unitOpt->id) ? $unitOpt->id:"")}}">{{ $unitOpt->name }}</option>
                                    @endforeach
                                </select>
                                @error('unit_types')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="label-control">Code</label>
                                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="Name" value="{{ old('code') ?? (isset($unit) ? $unit->code : "") }}" />
                                @error('code')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="" class="label-control">Description</label>
                                <textarea name="description" class="form-control" placeholder="Description" >{{ old('description') ?? (isset($unit) ? $unit->description : "") }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="" class="label-control">Symbol</label>
                                <input type="text" name="symbol" class="form-control" placeholder="Symbol" value="{{ old('symbol') ?? (isset($unit) ? $unit->symbol : "") }}" />
                            </div>
                            <div class="form-group">
                                <label for="" class="label-control">Factor</label>
                                <input type="text" name="factor" class="form-control" placeholder="Factor" value="{{ old('factor') ?? (isset($unit) ? $unit->factor : "") }}" />
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection