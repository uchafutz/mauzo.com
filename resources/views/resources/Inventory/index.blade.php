@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Inventory') }}</div>

                    <div class="card-body">
                       

                        <a href="{{ route("inventory.inventoryCategories.create") }}" class="btn btn-primary">Add</a>

                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($inventories as $Data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $Data->name }}</td>
                                        <td>{{ $Data->description }}</td>
                                        <td>
                                            <a href="{{ route("inventory.inventoryCategories.edit", ["inventoryCategory" => $Data]) }}" class="btn btn-info">Edit</a>
                                            <form action="{{ route("inventory.inventroryCategoies.destroy", ["inventoryCategory" => $Data]) }}" method="post">
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