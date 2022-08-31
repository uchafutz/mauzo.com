@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Unit') }}</div>

                    <div class="card-body">
                       

                        <a href="{{ route("config.units.create") }}" class="btn btn-primary">Add</a>

                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($unit as $unitModel)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $unitModel->name }}</td>
                                        <td>{{ $unitModel->code }}</td>
                                        <td>{{ $unitModel->description }}</td>
                                        <td>
                                            <a href="{{ route("config.units.edit", ["unit" => $unitModel]) }}" class="btn btn-info">Edit</a>
                                            <form action="{{ route("config.units.destroy", ["unit" => $unitModel]) }}" method="post">
                                                @csrf
                                                @method("delete")
                                            <button type="submit" class="btn btn-danger">delete</button>
                                             </form>
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