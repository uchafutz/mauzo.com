@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4></h4>
                    </div>
                    <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i>{{ __(' Items Details') }}</strong>
                        <p class="text-muted">
                        <table class="table table-bordered">
                            <tr>
                                <td>Name</td>
                                <td>{{ $inventoryItem->name }}</td>
                            </tr>
                            <tr>
                                <td>Image</td>
                                <td><img src="{{ $inventoryItem->featured_image }}" height="50px" alt="" /></td>
                            </tr>
                            <tr>
                                <td>Descriptin</td>
                                <td>{{ $inventoryItem->description }}</td>
                            </tr>
                            <tr>
                                <td>Unit</td>
                                <td>{{ $inventoryItem->unitType->name }}</td>
                            </tr>
                            <tr>
                                <td>Unit of Measurement </td>
                                <td>{{ $inventoryItem->unit->name }}</td>
                            </tr>
                            <tr>
                                <td>Stock</td>
                                <td>{{ $inventoryItem->in_stock }} {{ $inventoryItem->unit->code }}</td>
                            </tr>
                            <tr>
                                <td>Item </td>
                                <td>
                                    <div class="row row-cols-lg-auto g-3 align-items-center">
                                        <div class="col-12">
                                            <div class="form-check">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Is Material
                                                    @if ($inventoryItem->is_material == 1)
                                                        <span class="text-primary">
                                                            True
                                                        </span>
                                                    @else
                                                        <span class="text-danger">
                                                            False
                                                        </span>
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Is Product
                                                    @if ($inventoryItem->is_product == 1)
                                                        <span class="text-primary">
                                                            True
                                                        </span>
                                                    @else
                                                        <span class="text-danger">
                                                            False
                                                        </span>
                                                    @endif


                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Is Manufactured
                                                    @if ($inventoryItem->is_manufactured == 1)
                                                        <span class="text-primary">
                                                            True
                                                        </span>
                                                    @else
                                                        <span class="text-danger">
                                                            False
                                                        </span>
                                                    @endif


                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Inventory Item Category</td>
                                <td>{{ $inventoryItem->inventoryCategory->name }}</td>
                            </tr>
                        </table>
                        </p>
                        <hr>
                    </div>
                </div>

                <div class="card card-secondary">
                    <div class="card-header">
                        <h4></h4>
                    </div>
                    <div class="card-body ">

                        <p> <span><a class="btn btn-primary"
                                    href="{{ route('inventory.inventoryItems.inventoryItemMaterials.create', ['inventoryItem' => $inventoryItem]) }}"><i
                                        class="fas fa-plus">
                                    </i> Add Materials</a></span></p>
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
