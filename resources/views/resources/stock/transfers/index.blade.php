@extends('layouts.app')

@section('page_title')
    Stock Transfer
@endsection

@section('page_action')
    <a href="{{ route('stock.stockTransfers.create') }}" class="btn btn-primary"><i class="material-icons">add</i> Create
        Stock Transfer</a>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Code</th>
                                    <th>Operator</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>From</th>
                                    <th>To</th>

                                    <th width="100px">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($stockTransfers as $stockTransfer)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $stockTransfer->code }}</td>
                                        <td>{{ $stockTransfer->users->name ?? null }}</td>
                                        <td>{{ $stockTransfer->date }}</td>
                                        <td>{{ $stockTransfer->status }}</td>
                                        <td></td>
                                        <td></td>

                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                @if ($stockTransfer->status == 'SUBMITED')
                                                    <a href="{{ route('stock.stockTransfers.show', ['stockTransfer' => $stockTransfer]) }}"
                                                        class="btn btn-outline-success"><i
                                                            class="material-icons">visibility</i></a>
                                                @else
                                                    <a href="{{ route('stock.stockTransfers.show', ['stockTransfer' => $stockTransfer]) }}"
                                                        class="btn btn-outline-success"><i
                                                            class="material-icons">visibility</i></a>
                                                    <a href="{{ route('stock.stockTransfers.show', ['stockTransfer' => $stockTransfer]) }}"
                                                        class="btn btn-outline-primary"><i
                                                            class="material-icons">edit</i></a>

                                                    <form
                                                        action="{{ route('stock.stockTransfers.destroy', ['stockTransfer' => $stockTransfer]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')

                                                        <button type="submit" class="btn btn-outline-danger"><i
                                                                class="material-icons">delete_outline</i></button>
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
