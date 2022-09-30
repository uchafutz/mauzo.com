@extends('layouts.app')
@section('page_title')
    {{ __('Manufacturing') }}
@endsection

@section('page_action')
    <a href="{{ route('inventory.manufacturings.create') }}" class="btn btn-primary"><i class="material-icons">add</i>
        Create
        Manufacturing</a>
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
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th width="100px">Actions</th>
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
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('inventory.manufacturings.show', ['manufacturing' => $manufacturing]) }}"
                                                    class="btn btn-outline-success"><i
                                                        class="material-icons">visibility</i></a>
                                                <a href="{{ route('inventory.manufacturings.edit', ['manufacturing' => $manufacturing]) }}"
                                                    class="btn btn-outline-info"><i class="material-icons">edit</i></a>
                                                <form
                                                    action="{{ route('inventory.manufacturings.destroy', ['manufacturing' => $manufacturing]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-outline-danger"><i
                                                            class="material-icons">delete_outline</i></button>
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
