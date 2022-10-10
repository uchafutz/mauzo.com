@extends('layouts.app')

@section('page_title')
    @isset($manufacturing)
        Update Manufacturing
        @else
        New Manufacturing
    @endisset
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" x-data="getState()" x-init="init({{ json_encode($inventoryItems) }}, {{ json_encode($units) }}, {{ isset($manufacturing) ? json_encode($manufacturing) : null }} )">
                    <div class="card-header">{{ __('Manufacturing Form') }}</div>

                    <div class="card-body">

                        @isset($manufacturing)
                            <form action="{{ route("inventory.manufacturings.update", ["manufacturing" => $manufacturing]) }}" method="POST" enctype="multipart/form-data">
                                @method("patch")
                        @else
                            <form action="{{ route("inventory.manufacturings.store") }}" method="POST" enctype="multipart/form-data">
                        @endisset
                        
                            @csrf
                            <div class="form-group">
                                <label for="" class="label-control">Select Item</label>
                                <select name="inventory_item_id"  class="form-control @error('inventory_item_id') is-invalid @enderror" x-model="form.inventory_item_id">
                                    <option value="">Choose...</option>
                                    <template x-for="item in inventoryItems">
                                        <option x-bind:value="item.id" x-text="item.name" :selected="form.inventory_item_id === item.id"></option>
                                    </template>
                                </select>
                                @error('inventory_item_id')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="label-control">Select Unit</label>
                                <select name="config_unit_id"  class="form-control @error('config_unit_id') is-invalid @enderror" x-model="form.config_unit_id">
                                    <option value="">Choose...</option>
                                    <template x-for="unit in units.filter(u => form.inventory_item_id ? u.unit_type_id == form.item.unit_type_id : true)">
                                        <option x-bind:value="unit.id" x-text="unit.name" :selected="form.config_unit_id === unit.id"></option>
                                    </template>
                                </select>
                                @error('config_unit_id')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <x-form.custom-input name="quantity" type="number" label="Quantity" placeholder="Quantity" value="{{ isset($manufacturing) ? $manufacturing->quantity : null }}"/>
                            
                            <div class="form-group">
                                <label for="" class="label-control">Default Warehouse</label>
                                <select name="warehouse_id"  class="form-control @error('warehouse_id') is-invalid @enderror">
                                    <option value="">Choose...</option>
                                    @foreach ($warehouses as $warehouse)
                                        <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                    @endforeach
                                </select>
                                @error('config_unit_id')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <br/>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function getState() {
            return {
                inventoryItems: [],
                units: [],
                form: {
                    item: {},
                    unit: {},
                    inventory_item_id: null,
                    config_unit_id: null,
                },
                init(inventoryItems, units, manufacturing) {
                    this.inventoryItems = inventoryItems;
                    this.units = units;

                    this.$watch('form.inventory_item_id', id => {
                        const _item = this.inventoryItems.find(i => i.id == id);
                        if (_item) {
                            this.form.item = _item;
                            this.form.unit = {};
                        }
                    });
                    // this.$watch('form.config_unit_id', id => {
                    //     this.form.item = this.units.find(u => u.id == id);
                    // });

                    if (manufacturing) {
                        console.debug("manufacturing", manufacturing)
                        this.form.inventory_item_id = manufacturing.inventory_item_id;
                        this.form.config_unit_id = manufacturing.config_unit_id;
                    }
                }
            }
        }
    </script>
@endsection
