@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Purchases') }}</div>
                    <div class="card-body">
                        <a href="{{ route("purchase.purchases.create") }}" class="btn btn-primary btn-sm"><i class="fas fa-plus">
                        </i>Add</a>

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
                                        <div class="btn-group" role="group">
                                        @if ($purchase->status=="SUBMITED")
                                        <a href="{{ route("purchase.purchases.show",["purchase" =>$purchase]) }}" class="btn btn-success btn-sm"><i class="fas fa-check">
                                        </i> Procced</a>   
                                        @else
                                        <a href="{{ route("purchase.purchases.edit", ["purchase" => $purchase]) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt">
                                        </i> Edit</a>
                                        <a href="{{ route("purchase.purchases.show",["purchase" =>$purchase]) }}" class="btn btn-secondary btn-sm"><i class="fas fa-folder">
                                        </i> View</a>
                                        <form action="{{ route("purchase.purchases.destroy", ["purchase" => $purchase]) }}" method="post">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash">
                                            </i> Delete</button>
                                         </form> 
                                        @endif
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
@endsection