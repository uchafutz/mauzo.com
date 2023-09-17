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

                    <div class="card-body table-responsive">

                        <table class="table table-stripped" id="example">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Warehouse</th>
                                    <th width="100px">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->is_admin ? 'Admin' : 'Salesman' }}</td>
                                        <td>{{ $user->inventoryWarehouse->name }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('config.users.show', ['user' => $user]) }}"
                                                    class="btn btn-outline-success"><i
                                                        class="material-icons">visibility</i></a>
                                                <a href="{{ route('config.users.edit', ['user' => $user]) }}"
                                                    class="btn btn-outline-info"><i class="material-icons">edit</i></a>
                                                <form action="{{ route('config.users.destroy', ['user' => $user]) }}"
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
    <script>	
        new DataTable('#example');
    </script>
@endsection
