@extends('layouts.app')
@section('page_title')
    @isset($user)
        Update User
    @else
        New User
    @endisset
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">

                            @isset($user)
                            <form action="{{ route('config.users.update', ['user' => $user]) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('patch')
                            @else
                                <form action="{{ route('config.users.store') }}" method="POST" enctype="multipart/form-data">
                                @endisset

                                @csrf
                                <x-form.custom-input name="name" type="text" label="Name" placeholder="Name"
                                    value="{{ isset($user) ? $user->name : null }}" />

                                <br />

                                <x-form.custom-input name="email" type="email" label="Email" placeholder=""
                                    value="{{ isset($user) ? $user->email : null }}" />

                                <br />


                                <div class="form-group">
                                    <input type="checkbox" name="is_admin" id="is_admin_btn" class="me-2" {{ isset($user) && $user->is_admin ? 'checked':'' }}> Is Admin
                                </div>

                                <br />

                                <div>
                                    <label for="">Warehouse</label>
                                    <select name="inventory_warehouse_id" id="user_warehouse_id" class="form-control">
                                        <option value="">Assign warehouse</option>
                                        @foreach ($warehouses as $warehouse)
                                        <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <br />



                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
