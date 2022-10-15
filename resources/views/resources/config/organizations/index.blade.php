@extends('layouts.app')
@section('page_title')
    {{ __('Organization') }}
@endsection

@section('page_action')
        <a href="{{ route('config.organizations.create') }}" class="btn btn-primary"><i class="material-icons">add</i> Create
            Organization</a>
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
                                    <th>Logo</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th width="100px">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($organizations as $organization)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img src="{{ $organization->featured_image }}" alt="" srcset=""></td>
                                        <td>{{ $organization->name }}</td>
                                        <td>{{ $organization->address }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('config.organizations.edit', ['organization' => $organization]) }}"
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
