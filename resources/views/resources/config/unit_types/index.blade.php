@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Unit Types') }}</div>

                    <div class="card-body">
                       

                        <a href="{{ route("config.unitTypes.create") }}" class="btn btn-primary btn-sm"><i class="fas fa-plus">
                        </i>Add</a>

                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($unitTypes as $unitType)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $unitType->name }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                            <a href="{{ route("config.unitTypes.edit", ["unitType" => $unitType]) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt">
                                            </i>Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection