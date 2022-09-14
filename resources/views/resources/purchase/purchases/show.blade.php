@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Purchase') }}</div>
                    <div class="card-body">
                        <div>
                            <h4>{{ $purchase->code }}</h4>
                            <p></p>
                        </div>
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Purchase code</th>
                                    <th>Item</th>
                                    <th>Quantinty</th>
                                    <th>Unit Amount</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>

                            <tbody>
                               
                                   @foreach ($purchase->items as $purchaseItem)
                                   <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$purchaseItem->purchase->code}}</td>
                                    <td>{{$purchaseItem->inventoryItem->name}}</td>
                                    <td>{{$purchaseItem->quantity}} {{$purchaseItem->unit->code}}</td>
                                    <td>{{ number_format($purchaseItem->unit_price) }} TZS</td>
                                    <td>{{ number_format($purchaseItem->unit_price * $purchaseItem->quantity) }} TZS</td>
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