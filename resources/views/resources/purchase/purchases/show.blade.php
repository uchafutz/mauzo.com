@extends('layouts.app')

@section('page_title')
    {{ $purchase->code }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Purchase') }}</div>
                    <div class="card-body">
                        <div>
                            <h4>{{ $purchase->code }}</h4>
                            <p>{{ $purchase->date->format('d/m/Y') }}</p>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-stripped">
                                <thead>
                                    <tr>
                                        <th>S/n</th>
                                        <th>Purchase code</th>
                                        <th>Item</th>
                                        <th>Batch</th>
                                        <th>Quantinty</th>
                                        <th>Unit Amount</th>
                                        <th>Total Amount</th>
                                    </tr>
                                </thead>
    
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($purchase->items as $purchaseItem)
                                        @php
                                            $amount = $purchaseItem->unit_price * $purchaseItem->quantity;
                                            $total += $amount;
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $purchaseItem->purchase->code }}</td>
                                            <td>{{ $purchaseItem->inventoryItem->name }}</td>
                                            <td>{{ $purchaseItem->batch }}</td>
                                            <td>{{ $purchaseItem->quantity }} {{ $purchaseItem->unit->code }}</td>
                                            <td>{{ number_format($purchaseItem->unit_price) }} TZS</td>
                                            <td>{{ number_format($amount) }} TZS</td>
                                        </tr>
                                    @endforeach
                                </tbody>
    
                                <tfoot>
                                    <tr>
                                        <th colspan="6">Total:</th>
                                        <td align="">
                                            <h5>{{ number_format($total) }} TZS</h5>
                                        </td>
                                    </tr>
                                </tfoot>
    
                            </table>
                        </div>


                        @if ($purchase->status == 'DRAFT')
                            <form action="{{ route('purchase.purchases.purchaseSubmited', ['purchase' => $purchase]) }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label for=""
                                            class="label-control">{{ __('Select Inventory warehouse') }}</label>
                                        <select name="warehouse_id" id="warehouse_id" class="form-control" required>
                                            <option value="">Choose...</option>
                                            @foreach ($InventoryWarehouses as $InventoryWarehouse)
                                                <option value="{{ $InventoryWarehouse->id }}">
                                                    {{ $InventoryWarehouse->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br />

                                <button type="submit" class="btn btn-lg btn-success">Submit Purchase</button>
                            </form>
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
