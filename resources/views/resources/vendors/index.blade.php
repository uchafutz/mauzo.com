@extends('layouts.app')
@section('page_title')
    {{ __('Vendors List') }}
@endsection

@section('page_action')
    <a href="{{ route('vendor.vendors.create') }}" class="btn btn-primary"><i class="material-icons">add</i> Create
        Vendor</a>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"></div>

                    <div class="card-body">
                        <table id="example" class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th width="100px">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($vendors as $vendor)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $vendor->name }}</td>
                                        <td>{{ $vendor->phone }}</td>
                                        <td>{{ $vendor->email }}</td>
                                        <td>{{ $vendor->type }}</td>
                                        <td>{{ $vendor->description }}</>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('vendor.vendors.edit', ['vendor' => $vendor]) }}"
                                                    class="btn btn-outline-primary"><i class="material-icons">edit</i></a>
                                                <form
                                                    action="{{ route('vendor.vendors.destroy', ['vendor' => $vendor]) }}"
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
    <script>
        	
        new DataTable('#example');
    </script>
@endsection
