@extends('layouts.app')
@section('page_title')
    @isset($inventoryItem)
        Update InventoryItem
    @else
        New InventoryItem
    @endisset
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Add inventoryItem') }}</div>

                    <div class="card-body">

                        @isset($inventoryItem)
                            <form action="{{ route('inventory.inventoryItems.update', ['inventoryItem' => $inventoryItem]) }}"
                                method="POST" enctype="multipart/form-data">
                                @method('patch')
                            @else
                                <form action="{{ route('inventory.inventoryItems.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                @endisset

                                @csrf

                                <x-form.custom-input name="name" type="text" label="Name" placeholder="Enter name"
                                    value="{{ isset($inventoryItem) ? $inventoryItem->name : null }}" />
                                <div class="form-group">
                                    <label for="" class="label-control">Select Unit type</label>
                                    <select name="unit_type_id" id="unit_type_id"
                                        class="form-control  @error('unit_type_id') is-invalid @enderror">
                                        <option value=""></option>
                                        <option value="">Choose...</option>
                                        @foreach ($unitTypes as $unitType)
                                            <option value="{{ $unitType->id }}"
                                                {{ isset($unitType) && $unitType->id == $unitType->id ? 'selected' : '' }}>
                                                {{ $unitType->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <x-form.custom-textarea name="description" label="Description" placeholder="Description"
                                    value="{{ isset($inventoryItem) ? $inventoryItem->description : null }}" />
                                <div class="form-group">
                                    <label for="" class="label-control">Select Inventory category</label>
                                    <select name="inventory_category_id" id="inventory_category_id"
                                        class="form-control  @error('inventory_category_id') is-invalid @enderror">
                                        <option value="">Choose...</option>
                                        @foreach ($inventoryCategories as $invetoryCategory)
                                            <option
                                                value="{{ $invetoryCategory->id }}"{{ isset($invetoryCategory) && $invetoryCategory->id == $invetoryCategory->id ? 'selected' : '' }}>
                                                {{ $invetoryCategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <x-form.custom-input name="featured_image" type="file" label="Choose file"
                                    placeholder="Choose file"
                                    value="{{ isset($inventoryItem) ? $inventoryItem->featured_image : null }}" />
                                <div class="form-group">
                                    <label for="" class="label-control">Select Unit</label>
                                    <select name="default_unit_id" id="default_unit_id"
                                        class="form-control  @error('default_unit_id') is-invalid @enderror">
                                        <option value="">Choose...</option>
                                        @foreach ($units as $unit)
                                            <option
                                                value="{{ $unit->id }}"{{ isset($unit) && $unit->id == $unit->id ? 'selected' : '' }}>
                                                {{ $unit->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <br />
                                <div class="row row-cols-lg-auto g-3 align-items-center">
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" name="is_material" type="checkbox"
                                                value="1" id="flexCheckDefault"
                                                {{ isset($inventoryItem) && $inventoryItem->is_material == 1 ? ' checked' : '' }}>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Is Material
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" name="is_product" type="checkbox" value="1"
                                                id="flexCheckDefault"
                                                {{ isset($inventoryItem) && $inventoryItem->is_product == 1 ? ' checked' : '' }}>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Is Product
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" name="is_manufactured" type="checkbox"
                                                value="1" id="flexCheckDefault"
                                                {{ isset($inventoryItem) && $inventoryItem->is_manufactured == 1 ? ' checked' : '' }}>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Is Manufactured
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <x-form.custom-input name="reorder_level" type="text" label="Re order"
                                    placeholder="Enter Order"
                                    value="{{ isset($inventoryItem) ? $inventoryItem->reorder_level : null }}" />
                                <br />

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
