@extends('layouts.app')

@section('page_title')
    Purchases
@endsection

@section('page_action')
    <a href="{{ route("purchase.purchases.create") }}" class="btn btn-primary"><i class="material-icons">add</i> Create Purchase</a>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Purchases') }}</div>
                    <div class="card-body">

                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Code</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                               
                                   @foreach ($purchases as $purchase)
                                   <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$purchase->code}}</td>
                                    <td>{{$purchase->date}}</td>
                                    <td>{{ $purchase->status}}</td>
                                    <td>{{$purchase->description}}</td>
                                    <td>
                                        @if ($purchase->status=="SUBMITED")
                                        <a href="{{ route("purchase.purchases.show",["purchase" =>$purchase]) }}" class="btn btn-outline-success">View</a>   
                                        @else
                                        <a href="{{ route("purchase.purchases.show",["purchase" =>$purchase]) }}" class="btn btn-outline-success">View</a>
                                        <a href="{{ route("purchase.purchases.edit", ["purchase" => $purchase]) }}" class="btn btn-outline-info">Edit</a>
                                        
                                        <form action="{{ route("purchase.purchases.destroy", ["purchase" => $purchase]) }}" method="post">
                                            @csrf
                                            @method("delete")
                                        <button type="submit" class="btn btn-outline-danger">delete</button>
                                         </form> 
                                        @endif
                                       
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