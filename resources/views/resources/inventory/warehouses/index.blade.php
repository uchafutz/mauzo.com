@extends('layouts.app')
@section('page_title')
    {{ __('Inventory Warehouses') }}
@endsection

@section('page_action')
    <a href="{{ route('inventory.inventoryWarehouses.create') }}" class="btn btn-primary"><i class="material-icons">add</i>
        Create
        Inventory Warehouse</a>
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
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($inventoryWarehouses as $inventoryWarehouse)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img src="{{ $inventoryWarehouse->featured_image }}" height="50px"
                                                alt=""></td>
                                        <td>{{ $inventoryWarehouse->name }}</td>
                                        <td>{{ $inventoryWarehouse->description }}</td>
                                        <td>
                                            <a href="{{ route('inventory.inventoryWarehouses.edit', ['inventoryWarehouse' => $inventoryWarehouse]) }}"
                                                class="btn btn-info">Edit</a>
                                            <form
                                                action="{{ route('inventory.inventoryWarehouses.destroy', ['inventoryWarehouse' => $inventoryWarehouse]) }}"
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
