@extends('layouts.app')

@section('page_title')
    Manufacturing
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Manufacturings') }}</div>

                    <div class="card-body">
                       

                        <a href="{{ route("inventory.manufacturings.create") }}" class="btn btn-primary">Add</a>

                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($manufacturings as $manufacturing)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $manufacturing->item->name }}</td>
                                        <td>{{ $manufacturing->quantity }} {{ $manufacturing->unit->code }}</td>
                                        <td>{{ $manufacturing->status }}</td>
                                        <td>
                                            <a href="{{ route("inventory.manufacturings.show", ["manufacturing" => $manufacturing]) }}" class="btn btn-success">View</a>
                                            <a href="{{ route("inventory.manufacturings.edit", ["manufacturing" => $manufacturing]) }}" class="btn btn-info">Edit</a>
                                            <form action="{{ route("inventory.manufacturings.destroy", ["manufacturing" => $manufacturing]) }}" method="post">
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