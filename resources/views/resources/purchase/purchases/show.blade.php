@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Purchase Items') }}</div>
                    <div class="card-body">

                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Purchase code</th>
                                    <th>Item</th>
                                     <th>Unit</th>
                                    <th>Quantinty</th>
                                    <th>Amount</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                               
                                   @foreach ($purchaseItems as $purchaseItem)
                                   <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$purchaseItem->purchase->code}}</td>
                                    <td>{{$purchaseItem->inventoryItem->name}}</td>
                                    <td> {{$purchaseItem->unit->name}}</td>
                                    <td>{{$purchaseItem->quantity}}</td>
                                    <td>{{$purchaseItem->amount}}</td>
                                    <td>
                                     
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