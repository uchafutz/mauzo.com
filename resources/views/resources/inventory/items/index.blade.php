@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Inventory Items') }}</div>
                    <div class="card-body">
                        <a href="{{ route("inventory.inventoryItems.create") }}" class="btn btn-primary btn-sm"><i class="fas fa-plus">
                        </i>Add</a>

                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>In Stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($inventoryItems as $inventoryItem)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img src="{{ $inventoryItem->featured_image }}" height="50px" alt=""></td>
                                        <td>{{ $inventoryItem->name }}</td>
                                        <td>{{ $inventoryItem->description }}</td>
                                        <td>{{ $inventoryItem->in_stock }} {{ $inventoryItem->unit->code }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                            <a href="{{ route("inventory.inventoryItems.edit", ["inventoryItem" => $inventoryItem]) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt">
                                            </i> Edit</a>
                                            <a href="{{ route("inventory.inventoryItems.show",["inventoryItem" =>$inventoryItem]) }}" class="btn btn-secondary btn-sm"><i class="fas fa-folder">
                                            </i>view</a>
                                            <form action="{{ route("inventory.inventoryItems.destroy", ["inventoryItem" => $inventoryItem]) }}" method="post">
                                                @csrf
                                                @method("delete")
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash">
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