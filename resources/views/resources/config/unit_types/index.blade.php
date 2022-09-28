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
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"></div>

                    <div class="card-body">



                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($unitTypes as $unitType)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $unitType->name }}</td>
                                        <td>
                                            <a href="{{ route('config.unitTypes.edit', ['unitType' => $unitType]) }}"
                                                class="btn btn-info">Edit</a>
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
