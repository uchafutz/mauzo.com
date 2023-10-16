@extends('layouts.app')
@section('page_title')
    @isset($vat)
        Update Vat
    @else
        New Vat
    @endisset
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">

                        @isset($vat)
                            <form action="{{ route('config.vats.update', ['vat' => $vat]) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('patch')
                            @else
                                <form action="{{ route('config.vats.store') }}" method="POST" enctype="multipart/form-data">
                                @endisset

                                @csrf
                                <x-form.custom-input name="name" type="text" label="Name" placeholder="Name"
                                    value="{{ isset($vat) ? $vat->name : null }}" />
                                <x-form.custom-input name="vat_number" type="number" label="Vat No: %" placeholder=""
                                    value="{{ isset($vat) ? $vat->vat_number : null }}" />

                                <br />


                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
