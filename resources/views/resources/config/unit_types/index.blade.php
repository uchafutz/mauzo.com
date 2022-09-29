@extends('layouts.app')
@section('page_title')
    {{ __('Unit Types') }}
@endsection

@section('page_action')
    <a href="{{ route('config.unitTypes.create') }}" class="btn btn-primary"><i class="material-icons">add</i> Create
        Unit Type</a>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>

                    <div class="card-body">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Name</th>
                                    <th width="100px">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($unitTypes as $unitType)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $unitType->name }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('config.unitTypes.edit', ['unitType' => $unitType]) }}"
                                                    class="btn btn-outline-info"><i class="material-icons">edit</i></a>
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
