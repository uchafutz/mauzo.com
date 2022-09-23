@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Units') }}</div>

                    <div class="card-body">
                       

                        <a href="{{ route("config.units.create") }}" class="btn btn-primary btn-sm"><i class="fas fa-plus">
                        </i>Add</a>

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
                                @foreach ($units as $unit)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $unit->name }}</td>
                                        <td>{{ $unit->code }}</td>
                                        <td>{{ $unit->description }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                            <a href="{{ route("config.units.edit", ["unit" => $unit]) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt">
                                            </i>Edit</a>
                                            <form action="{{ route("config.units.destroy",["unit" => $unit]) }}" method="post">
                                                @csrf
                                                @method("delete")
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash">
                                            </i>delete</button>
                                             </form>
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