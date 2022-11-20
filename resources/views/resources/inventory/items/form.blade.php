@extends('layouts.app')
@section('page_title')
    @isset($inventoryItem)
        Update Item
    @else
        New Item
    @endisset
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body" x-data="getState()" x-init="initialize({{ json_encode($units) }}, {{ json_encode($unitTypes) }}, {{ isset($inventoryItem) ? json_encode($inventoryItem) : null }})">

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
                                    <select name="unit_type_id" x-model="form.unit_type_id" id="unit_type_id"
                                        class="form-control  @error('unit_type_id') is-invalid @enderror" @isset($inventoryItem) disabled @endisset>
                                        <option value="">Choose...</option>
                                        <template x-for="unitType in unitTypes">
                                            <option x-bind:value="unitType.id" x-text="unitType.name"
                                                x-bind:selected="unitType.id == form.unit_type_id"></option>
                                        </template>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="" class="label-control">Select Unit</label>
                                    <select name="default_unit_id" id="default_unit_id"
                                        class="form-control  @error('default_unit_id') is-invalid @enderror" @isset($inventoryItem) disabled @endisset>
                                        <option value="">Choose...</option>
                                        <template
                                            x-for="unit in units.filter(u => form.unit_type_id ? form.unit_type_id == u.unit_type_id : true)">
                                            <option x-bind:value="unit.id" x-text="unit.name"
                                                x-bind:selected="unit.id == form.conf_unit_id"
                                                x-bind:selected="unit.id == form.conf_unit_id"></option>
                                        </template>

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
                                <x-form.custom-input name="sale_price" type="text" label="Sale price"
                                    placeholder="Enter sale amount"
                                    value="{{ isset($inventoryItem) ? $inventoryItem->sale_price : null }}" />
                                <br />

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        const initialForm = {
            unit_type_id: "",
            conf_unit_id: "",
        }

        function getState() {
            return {
                units: [],
                form: initialForm,
                unitTypes: [],
                item: {},
                initialize(units, unitTypes, item) {
                    this.units = units;
                    this.unitTypes = unitTypes;
                    this.item = item ?? {}

                    if (item) {
                        this.form.unit_type_id = item.unit_type_id;
                        this.form.conf_unit_id = item.default_unit_id;
                    }
                }
            }

        }
    </script>
@endsection
