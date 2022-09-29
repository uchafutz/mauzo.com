@extends('layouts.app')
@section('page_title')
    {{ __('Roles') }}
@endsection

@section('page_action')
    <a href="{{ route('config.roles.create') }}" class="btn btn-primary"><i class="material-icons">add</i> Create
        Role</a>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"></div>

                    <div class="card-body">

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
                                            <a href="{{ route('config.roles.show', ['role' => $role]) }}"
                                                class="btn btn-primary">show</a>
                                            <a href="{{ route('config.roles.edit', ['role' => $role]) }}"
                                                class="btn btn-info">Edit</a>
                                            <form action="{{ route('config.roles.destroy', ['role' => $role]) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
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
