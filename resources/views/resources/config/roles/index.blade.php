@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Roles') }}</div>

                    <div class="card-body">
                       

                        <a href="{{ route("config.roles.create") }}" class="btn btn-primary btn-sm"><i class="fas fa-plus">
                        </i>Add</a>

                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Name</th>
                                    <th>Display</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->display }}</td>
                                        <td>{{ $role->description }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                            <a href="{{ route("config.roles.edit", ["role" => $role]) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt">
                                            </i>Edit</a>
                                            <a href="{{ route("config.roles.show", ["role" => $role]) }}" class="btn btn-secondary btn-sm"><i class="fas fa-folder">
                                            </i>show</a>
                                           
                                            <form action="{{ route("config.roles.destroy",["role" => $role]) }}" method="post">
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