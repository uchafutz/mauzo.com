@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Purchases') }}</div>
                    <div class="card-body">
                        <a href="{{ route("purchase.purchases.create") }}" class="btn btn-primary">Add</a>

                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Code</th>
                                    <th>Date</th>
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
                                    <td>{{$purchase->description}}</td>
                                    <td>
                                        <a href="{{ route("purchase.purchases.edit", ["purchase" => $purchase]) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ route("purchase.purchases.show",["purchase" =>$purchase]) }}" class="btn btn-success">View</a>
                                        <form action="{{ route("purchase.purchases.destroy", ["purchase" => $purchase]) }}" method="post">
                                            @csrf
                                            @method("delete")
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