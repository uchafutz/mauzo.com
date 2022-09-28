@extends('layouts.app')
@section('page_title')
    {{ __('Units') }}
@endsection

@section('page_action')
    <a href="{{ route('config.units.create') }}" class="btn btn-primary"><i class="material-icons">add</i> Create
        Unit</a>
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
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($units as $unit)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $unit->name }}</td>
                                        <td>{{ $unit->code }}</td>
                                        <td>{{ $unit->description }}</td>
                                        <td>
                                            <a href="{{ route('config.units.edit', ['unit' => $unit]) }}"
                                                class="btn btn-info">Edit</a>
                                            <form action="{{ route('config.units.destroy', ['unit' => $unit]) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
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
