@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Customer List') }}</div>

                    <div class="card-body">
                       

                        <a href="{{ route("customer.customers.create") }}" class="btn btn-primary btn-sm"><i class="fas fa-plus">
                        </i>Add</a>

                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->address}}</td>
                                        <td>{{ $customer->phone}}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                            <a href="{{ route("customer.customers.edit", ["customer" => $customer]) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt">
                                            </i>Edit</a>
                                            <form action="{{ route("customer.customers.destroy",["customer" => $customer]) }}" method="post">
                                                @csrf
                                                @method("delete")
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash">
                                            </i> delete</button>
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
@endsection