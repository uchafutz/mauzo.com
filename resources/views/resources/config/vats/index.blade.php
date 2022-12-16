@extends('layouts.app')
@section('page_title')
    {{ __('Vats') }}
@endsection

@section('page_action')
    <a href="{{ route('config.vats.create') }}" class="btn btn-primary"><i class="material-icons">add</i> Create
        Vat</a>
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
                                    <th>Vat %</th>
                                    <th width="100px">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($vats as $vat)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $vat->name }}</td>
                                        <td>{{ $vat->vat_number }}</td>

                                        <td>
                                            <div class="btn-group" vat="group" aria-label="Basic example">

                                                <a href="{{ route('config.vats.edit', ['vat' => $vat]) }}"
                                                    class="btn btn-outline-info"><i class="material-icons">edit</i></a>
                                                <form action="{{ route('config.vats.destroy', ['vat' => $vat]) }}"
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
