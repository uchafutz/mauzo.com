@extends('layouts.app')

@section('page_title')
    {{ $inventoryItem->name }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card"></div>

                <div class="card">
                    <div class="card-header">{{ __('View Inventory Materials') }}</div>
                    <div class="card-body">
                        <p><span><a class="btn btn-info"
                                    href="{{ route('inventory.inventoryItems.inventoryItemMaterials.create', ['inventoryItem' => $inventoryItem]) }}">
                                    Add Materials</a></span></p>
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($inventoryItem->materials as $inventoryItemMaterial)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $inventoryItemMaterial->materialItem->name }}</td>
                                        <td>{{ $inventoryItemMaterial->quantity }}
                                            {{ $inventoryItemMaterial->materialItem->unit->name }}</td>
                                        <td>{{ $inventoryItemMaterial->type }}</td>
                                        <td>
                                            <a href="{{ route('inventory.inventoryItems.inventoryItemMaterials.edit', ['inventoryItemMaterial' => $inventoryItemMaterial, 'inventoryItem' => $inventoryItem]) }}"
                                                class="btn btn-info">Edit</a>
                                            <form
                                                action="{{ route('inventory.inventoryItems.inventoryItemMaterials.destroy', ['inventoryItemMaterial' => $inventoryItemMaterial, 'inventoryItem' => $inventoryItem]) }}"
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

                <div class="card mt-2">
                    <div class="card-header">{{ __('Stock Items') }}</div>
                    <div class="card-body">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Source</th>
                                    <th>Warehouse</th>
                                    <th>Quantity</th>
                                    <th>Unit Cost</th>
                                    <th>In Stock</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($inventoryItem->stockItems as $stockItem)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ get_class($stockItem->source) }}</td>
                                        <td>{{ $stockItem->warehouse->name }}</td>
                                        <td>{{ $stockItem->quantity }}</td>
                                        <td>{{ $stockItem->unit_cost }}</td>
                                        <td>{{ $stockItem->in_stock }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-header">{{ __('Available In Warehouse') }}</div>
                    <div class="card-body">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Warehouse</th>
                                    <th>In Stock</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($inventoryItem->warehouses as $warehouse)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $warehouse->name }}</td>
                                        <td>{{ $warehouse->pivot->in_stock }}</td>
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
