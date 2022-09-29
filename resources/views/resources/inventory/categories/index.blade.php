@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Inventory Categories') }}</div>
                    <div class="card-body">
                        <a href="{{ route("inventory.inventoryCategories.create") }}" class="btn btn-primary btn-sm"><i class="fas fa-plus">
                        </i> Add</a>

                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Name</th>
                                    <th>Parent</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($inventoryCategories as $inventoryCategory)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $inventoryCategory->name }}</td>
                                        <td>{{ $inventoryCategory->parent ? $inventoryCategory->parent->name : "N/A" }}</td>
                                        <td>{{ $inventoryCategory->description }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                            <a href="{{ route("inventory.inventoryCategories.edit", ["inventoryCategory" => $inventoryCategory]) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt">
                                            </i> Edit</a>
                                            <form action="{{ route("inventory.inventoryCategories.destroy", ["inventoryCategory" => $inventoryCategory]) }}" method="post">
                                                @csrf
                                                @method("delete")
                                            <button type="submit" class="btn btn-danger btn-sm"> <i class="fas fa-trash">
                                            </i> delete</button>
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