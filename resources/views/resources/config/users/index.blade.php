@extends('layouts.app')
@section('page_title')
    {{ __('User') }}
@endsection

@section('page_action')
    <a href="{{ route('config.users.create') }}" class="btn btn-primary"><i class="material-icons">add</i> Create
        User</a>
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
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <a href="{{ route('config.users.show', ['user' => $user]) }}"
                                                class="btn btn-primary">view</a>
                                            <a href="{{ route('config.users.edit', ['user' => $user]) }}"
                                                class="btn btn-info">Edit</a>
                                            <form action="{{ route('config.users.destroy', ['user' => $user]) }}"
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
