@extends('layouts.app')
@section('page_title')
    {{ __('Inventory Items') }}
@endsection

@section('page_action')
    <a href="{{ route('inventory.inventoryItems.create') }}" class="btn btn-primary"><i class="material-icons">add</i>
        Create
        Inventory Item</a>
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
                                        <td><img src="{{ $inventoryItem->featured_image }}" height="50px" alt="">
                                        </td>
                                        <td>{{ $inventoryItem->name }}</td>
                                        <td>{{ $inventoryItem->description }}</td>
                                        <td>{{ $inventoryItem->in_stock }} {{ $inventoryItem->unit->code }}</td>
                                        <td>
                                            <a href="{{ route('inventory.inventoryItems.edit', ['inventoryItem' => $inventoryItem]) }}"
                                                class="btn btn-info">Edit</a>
                                            <a href="{{ route('inventory.inventoryItems.show', ['inventoryItem' => $inventoryItem]) }}"
                                                class="btn btn-success">View item</a>
                                            <form
                                                action="{{ route('inventory.inventoryItems.destroy', ['inventoryItem' => $inventoryItem]) }}"
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
