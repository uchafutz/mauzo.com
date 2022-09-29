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
                                    <th width="100px">Actions</th>
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
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('config.roles.show', ['role' => $role]) }}"
                                                    class="btn btn-outline-success"><i
                                                        class="material-icons">visibility</i></a>
                                                <a href="{{ route('config.roles.edit', ['role' => $role]) }}"
                                                    class="btn btn-outline-info"><i class="material-icons">edit</i></a>
                                                <form action="{{ route('config.roles.destroy', ['role' => $role]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-outline-danger"><i
                                                            class="material-icons">delete_outline</i></button>

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
