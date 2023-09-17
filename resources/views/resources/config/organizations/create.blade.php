@extends('layouts.app')
@section('page_title')
    @isset($organization)
        Update Organization
    @else
        New Organization
    @endisset
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">

                        @isset($organization)
                            <form action="{{ route('config.organizations.update', ['organization' => $organization]) }}"
                                method="POST" enctype="multipart/form-data">
                                @method('patch')
                            @else
                                <form action="{{ route('config.organizations.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                @endisset

                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <x-form.custom-input name="name" type="text" label="Name" placeholder="Name"
                                            value="{{ isset($organization) ? $organization->name : null }}" />
                                    </div>
                                    <div class="col-md-6">
                                        <x-form.custom-input name="address" type="text" label="Address" placeholder=""
                                            value="{{ isset($organization) ? $organization->address : null }}" />
                                    </div>
                                    <br />
                                    <div class="col-md-6">
                                        <x-form.custom-input name="phone" type="text" label="Phone" placeholder=""
                                            value="{{ isset($organization) ? $organization->phone : null }}" />
                                    </div>
                                    <div class="col-md-6">
                                        <x-form.custom-input name="featured_image" type="file" label="Logo"
                                            placeholder=""
                                            value="{{ isset($organization) ? $organization->featured_image : null }}" />
                                    </div>



                                </div>
                                <br />
                                <div>
                                    <textarea name="description" class="form-group" id="" cols="60" rows="10"></textarea>
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
