@extends('layouts.app')

@section('page_title')
    Sales
@endsection

@section('page_action')
    <a href="{{ route("sale.sales.create") }}" class="btn btn-primary"><i class="material-icons">add</i>Record Sale</a>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Sale List') }}</div>

                    <div class="card-body">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Code</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($sales as $sale)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $sale->code }}</td>
                                        <td>{{ $sale->date->format("m-d-Y") }}</td>
                                        <td>{{ number_format($sale->total_amount, null, null, " ") }} TZS</td>
                                        <th class="{{ $sale->status == 'DRAFT' ? 'text-warning' : 'text-success' }}">{{ $sale->status}}</th>
                                        <td class="tex-right">
                                            <div class="btn-group" role="group">
                                                <a class="btn btn-outline-success" href="{{ route("sale.sales.show", ["sale" => $sale]) }}"><i class="material-icons">visibility</i></a>
                                                <a href="{{ route("sale.sales.edit", ["sale" => $sale]) }}" class="btn btn-outline-info"><i class="material-icons">edit</i></a>
                                                <form action="{{ route("sale.sales.destroy",["sale" => $sale]) }}" method="post">
                                                    @csrf
                                                    @method("delete")
                                                    <button type="submit" class="btn btn-outline-danger"><i class="material-icons">delete_outline</i></button>
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