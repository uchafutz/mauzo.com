@extends('layouts.app')
@section('page_title')
    {{ __('Inventory Categories') }}
@endsection

@section('page_action')
    <a href="{{ route('inventory.inventoryCategories.create') }}" class="btn btn-primary"><i class="material-icons">add</i>
        Create
        Inventory Category</a>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
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
                                        <td>{{ $inventoryCategory->parent ? $inventoryCategory->parent->name : 'N/A' }}</td>
                                        <td>{{ $inventoryCategory->description }}</td>
                                        <td>
                                            <a href="{{ route('inventory.inventoryCategories.edit', ['inventoryCategory' => $inventoryCategory]) }}"
                                                class="btn btn-info">Edit</a>
                                            <form
                                                action="{{ route('inventory.inventoryCategories.destroy', ['inventoryCategory' => $inventoryCategory]) }}"
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
