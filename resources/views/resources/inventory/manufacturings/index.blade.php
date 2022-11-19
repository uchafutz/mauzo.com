@extends('layouts.app')
@section('page_title')
    {{ __('Manufacturing') }}
@endsection

@section('page_action')
    <a href="{{ route('inventory.manufacturings.create') }}" class="btn btn-primary"><i class="material-icons">add</i>
        Create
        Manufacturing</a>
@endsection

@section('page_action')
    <a href="{{ route('inventory.manufacturings.create') }}" class="btn btn-primary"><i class="material-icons">add</i>
        Manufacture Item</a>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Manufacturings') }}</div>
                    <div class="card-body">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Item</th>
                                    <th>Operator</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th width="100px">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($manufacturings as $manufacturing)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $manufacturing->item->name ?? null }}</td>
                                        <td>{{ $manufacturing->users->name ?? null }}</td>
                                        <td>{{ $manufacturing->quantity }} {{ $manufacturing->unit->code }}</td>
                                        @switch($manufacturing->status)
                                            @case('DRAFT')
                                                <td class="text-warning">{{ $manufacturing->status }}</td>
                                            @break

                                            @case('BOQ')
                                                <td class="text-primary">{{ $manufacturing->status }}</td>
                                            @break

                                            @default
                                                <td class="text-success">{{ $manufacturing->status }}</td>
                                        @endswitch
                                        <td class="text-right">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('inventory.manufacturings.show', ['manufacturing' => $manufacturing]) }}"
                                                    class="btn btn-outline-success"><i
                                                        class="material-icons">visibility</i></a>
                                                @if ($manufacturing->status == 'DRAFT')
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
