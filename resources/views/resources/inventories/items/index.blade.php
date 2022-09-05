@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Inventory Items') }}</div>
                    <div class="card-body">
                        <a href="{{ route("inventory.inventoryItems.create") }}" class="btn btn-primary">Add</a>

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
                                @foreach ($inventoryItems as $inventoryItem)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $inventoryItem->name }}</td>
                                        <td>{{ $inventoryItem->description }}</td>
                                        <td>
                                            <a href="{{ route("inventory.inventoryItems.edit", ["inventoryItem" => $inventoryItem]) }}" class="btn btn-info">Edit</a>
                                            <form action="{{ route("inventory.inventoryItems.destroy", ["inventoryItem" => $inventoryItem]) }}" method="post">
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