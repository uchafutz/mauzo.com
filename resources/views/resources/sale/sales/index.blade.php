@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Sale List') }}</div>

                    <div class="card-body">
                       

                        <a href="{{ route("sale.sales.create") }}" class="btn btn-primary btn-sm"><i class="fas fa-plus">
                        </i>Add</a>

                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Code</th>
                                     <th>Date</th>
                                    <th>Status</th>
                                    <th>Descriptin</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($sales as $sale)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $sale->code }}</td>
                                        <td>{{ $sale->date}}</td>
                                        <th>{{ $sale->status}}</th>
                                        <td>{{ $sale->description}}</td>
                                        <td class="tex-right">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route("sale.sales.edit", ["sale" => $sale]) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt">
                                                </i>Edit</a>
                                            <a class="btn btn-secondary btn-sm" href="{{ route("sale.sales.show", ["sale" => $sale]) }}">
                                                <i class="fas fa-folder">
                                                </i>
                                                View
                                                </a>
                                            
                                            <form action="{{ route("sale.sales.destroy",["sale" => $sale]) }}" method="post">
                                                @csrf
                                                @method("delete")
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash">
                                            </i>Delete</button>
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