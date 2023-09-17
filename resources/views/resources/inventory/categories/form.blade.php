@extends('layouts.app')
@section('page_title')
    @isset($inventoryCategory)
        Update Inventory Category
    @else
        New Inventory Category
    @endisset
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>

                    <div class="card-body">

                        @isset($inventoryCategory)
                            <form
                                action="{{ route('inventory.inventoryCategories.update', ['inventoryCategory' => $inventoryCategory]) }}"
                                method="POST" enctype="multipart/form-data">
                                @method('patch')
                            @else
                                <form action="{{ route('inventory.inventoryCategories.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                @endisset

                                @csrf

                                <x-form.custom-input name="name" type="text" label="Name" placeholder="Enter name"
                                    value="{{ isset($inventoryCategory) ? $inventoryCategory->name : null }}" />
                                <div class="form-group">
                                    <label for=""
                                        class="label-control">{{ __('Select Inventory category') }}</label>

                                        <select name="parent_id" id="parent_id" class="form-control">
                                            <option value="">Choose...</option>
                                            @foreach ($inventoryCategories as $inventoryCategoryVariant)
                                                <option value="{{ $inventoryCategoryVariant->id }}"
                                                    {{ isset($inventoryCategory) && $inventoryCategory->parent_id == $inventoryCategoryVariant->id ? 'selected' : '' }}>
                                                    {{ $inventoryCategoryVariant->name }}</option>
                                            @endforeach
                                        </select>
                                </div>

                                <x-form.custom-textarea name="description" label="Description" placeholder="Description"
                                    value="{{ isset($inventoryCategory) ? $inventoryCategory->description : null }}" />
                                <br />

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
