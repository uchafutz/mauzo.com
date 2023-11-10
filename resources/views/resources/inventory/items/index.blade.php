@extends('layouts.app')
@section('page_title')
    {{ __('Inventory Items') }}
@endsection

@section('page_action')
<div class="row">
    <div class="col-md-6">
        <a href="{{ route('inventory.inventoryItems.create') }}" class="btn btn-primary"><i class="material-icons">add</i>
            Create
            Inventory Item</a>
    </div>
    <div class="col-md-6">
        <div class="row">
            <h4>Stock Availability Report</h4>
        </div>
        <form action="{{ route('inventory.stocks.report') }}" method="post">
            @csrf
            <div class="col">
                <div class="row mb-2">
                    <select name="warehouse_id" id="" class="form-control">
                        <option value="">Select warehouse</option>
                        @foreach ($wareHouses as $warehouse)
                            <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>    
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <button class="btn btn-success">
                        <i class="material-icons-outlined">file_download</i>Get report
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="example" class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>R-Level</th>
                                    <th>In Stock</th>
                                    <th>Selling Price</th>
                                    <th width="100px">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($inventoryItems as $inventoryItem)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img src="{{ $inventoryItem->featured_image }}" height="50px" alt="">
                                        </td>
                                        <td>{{ $inventoryItem->name }}</td>
                                        <td>{{ $inventoryItem->reorder_level }}</td>
                                        <td
                                            class="{{ $inventoryItem->in_stock > $inventoryItem->reorder_level ? 'text-success' : 'text-danger' }}">
                                            {{ $inventoryItem->in_stock ?? 0 }} {{ $inventoryItem->unit->code ?? null }}
                                        </td>

                                        <td>{{ number_format($inventoryItem->sale_price, 2, null, ' ') }} TZS</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('inventory.inventoryItems.edit', ['inventoryItem' => $inventoryItem]) }}"
                                                    class="btn btn-outline-info"><i class="material-icons">edit</i></a>
                                                <a href="{{ route('inventory.inventoryItems.show', ['inventoryItem' => $inventoryItem]) }}"
                                                    class="btn btn-outline-success"><i
                                                        class="material-icons">visibility</i></a>
                                                <form
                                                    action="{{ route('inventory.inventoryItems.destroy', ['inventoryItem' => $inventoryItem]) }}"
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
