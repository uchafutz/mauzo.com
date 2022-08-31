@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Unit') }}</div>

                    <div class="card-body">
                       
                        @isset($unitModel)
                            <form action="{{ route("config.unit.update", ["unitModel" => $unitModel]) }}" method="POST" enctype="multipart/form-data">
                                @method("patch")
                        @else
                            <form action="{{ route("config.unit.store") }}" method="POST" enctype="multipart/form-data">
                        @endisset
                        
                            @csrf

                            <div class="form-group">
                                <label for="" class="label-control">Name Unit</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') ?? (isset($unitType) ? $unitType->name : "") }}" />
                            </div>
                            <div class="form-group">
                                <label for="" class="label-control">Unit Type</label>
                                <select name="unit_type" id="">
                                    @foreach($unitType as $unitOpt)
                                    <option value="{{ old('unit_type')??(isset($unitOpt->id) ? $unitOpt->id:"")}}">{{ $unitOpt->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="label-control">Code</label>
                                <input type="text" name="code" class="form-control" placeholder="Name" value="{{ old('code') ?? (isset($unitModel) ? $unitModel->code : "") }}" />
                            </div>

                            <div class="form-group">
                                <label for="" class="label-control">Description</label>
                                <textarea name="description" class="form-control" placeholder="Description" >{{ old('description') ?? (isset($unitModel) ? $unitModel->description : "") }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="" class="label-control">Symbol</label>
                                <input type="text" name="symbol" class="form-control" placeholder="Symbol" value="{{ old('symbol') ?? (isset($unitModel) ? $unitModel->symbol : "") }}" />
                            </div>
                            <div class="form-group">
                                <label for="" class="label-control">Factor</label>
                                <input type="text" name="factor" class="form-control" placeholder="Factor" value="{{ old('factor') ?? (isset($unitModel) ? $unitModel->factor : "") }}" />
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection