@extends('layouts.app')

@section('page_title')
    {{ $stockTransfer->code }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Stock TransFer') }}</div>
                    <div class="card-body">
                        <div>
                            <h4>{{ $stockTransfer->code }}</h4>
                            <p>{{ $stockTransfer->date->format('d/m/Y') }}</p>
                        </div>
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Stock code</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Action </th>

                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($stockTransfer->items as $stockTransferItem)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $stockTransferItem->stockTransfer->code }}</td>
                                        <td>{{ $stockTransferItem->inventoryItem->name }}</td>
                                        <td>{{ $stockTransferItem->quantity }} {{ $stockTransferItem->unit->code }}</td>
                                        <td> </td>


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
