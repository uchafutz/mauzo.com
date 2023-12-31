@extends('layouts.app')

@section('page_title')
    @isset($purchase)
        Update Purchase
    @else
        New Purchase
    @endisset
@endsection

@section('content')
    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" x-data="getState()" x-init="initialize({{ json_encode($items) }}, {{ json_encode($units) }}, {{ json_encode($vendors) }}, {{ isset($purchase) ? json_encode($purchase->items) : json_encode([]) }})">
                        @isset($purchase)
                            <form class="row g-3" action="{{ route('purchase.purchases.update', ['purchase' => $purchase]) }}"
                                method="POST" enctype="multipart/form-data">
                                @method('patch')
                            @else
                                <form class="row g-3" action="{{ route('purchase.purchases.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @endisset
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" required>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <x-form.custom-input type="date" name="date" label="Purchase Date"
                                            value="{{ isset($purchase) ? $purchase->date->format('Y-m-d') : date('Y-m-d') }}" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="" class="label-control">Vendor</label>
                                        <select class="form-control" name="vendor_id">
                                            <option value="">Choose Vendor...</option>
                                            @foreach ($vendors as $vendor)
                                                <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <x-form.custom-textarea name="description" label="Purchase Description"
                                        value="{{ isset($purchase) ? $purchase->description : '' }}" />
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="" class="label-control">Inventory Item</label>
                                        <select class="form-control" x-model="form.inv_item_id">
                                            <option value="">Choose Item...</option>
                                            <template
                                                x-for="item in inventoryItems.filter(i => !items.find(it => it.inv_item_id == i.id))">
                                                <option x-bind:value="item.id" x-text="item.name"></option>
                                            </template>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="" class="label-control">Batch</label>
                                        <input type="text" placeholder="Batch"
                                            class="batch border form-control" x-model="form.batch">
                                    </div>
                                </div>
                           
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <label for="" class="label-control">Unit of Meansure</label>
                                                <select class="form-control" x-model="form.conf_unit_id">
                                                    <option value="">Choose Unit</option>
                                                    <template
                                                        x-for="item in units.filter(u => form.item ? u.unit_type_id == form.item.unit_type_id : true)">
                                                        <option x-bind:value="item.id" x-text="item.name"></option>
                                                    </template>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="" class="label-control">Quantity</label>
                                                <input type="number" placeholder="Qty" max=""
                                                    class="quantity border form-control" x-model="form.quantity">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="" class="label-control">Unit Price</label>
                                                <input type="number" placeholder="Unit Amount" x-model="form.unit_price"
                                                    class="quantity border form-control">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="" class="label-control">&nbsp;</label>
                                                <div x-show="active == -1">
                                                    <button type="button" class="btn btn-info d-block w-full"
                                                        x-on:click="add">Add</button>
                                                </div>
                                                <div x-show="active != -1">
                                                    <button type="button" class="btn btn-info d-block w-full"
                                                        x-on:click="update">Update</button>
                                                </div>
                                            </div>
                                        </div>
                        
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <tr>
                                            <th>S/n</th>
                                            <th>Item</th>
                                            <th>Batch</th>
                                            <th>Unit</th>
                                            <th>Quantity</th>
                                            <th>Unit Amount</th>
                                            <th>Amount</th>
                                            <th></th>
                                        </tr>
                                        <tbody>
                                            <template x-for="(item, index) in items">
                                                <tr>
                                                    @isset($purchase)
                                                        <input type="hidden" x-bind:name="'items[' + index + '][id]'"
                                                            x-bind:value="item.id">
                                                    @endisset

                                                    <input type="hidden" x-bind:name="'items[' + index + '][inv_item_id]'"
                                                        x-bind:value="item.inv_item_id">
                                                    <input type="hidden" x-bind:name="'items[' + index + '][conf_unit_id]'"
                                                        x-bind:value="item.conf_unit_id">
                                                    <input type="hidden" x-bind:name="'items[' + index + '][quantity]'"
                                                        x-bind:value="item.quantity">
                                                    <input type="hidden" x-bind:name="'items[' + index + '][batch]'"
                                                        x-bind:value="item.batch">
                                                    <input type="hidden" x-bind:name="'items[' + index + '][unit_price]'"
                                                        x-bind:value="item.unit_price">

                                                    <td x-text="index + 1"></td>
                                                    <td x-text="item.item.name"></td>
                                                    <td x-text="item.batch"></td>
                                                    <td x-text="item.unit.name"></td>
                                                    <td x-text="item.quantity"></td>
                                                    <td align="right" x-text="item.unit_price"></td>
                                                    <td align="right" x-text="item.unit_price * item.quantity"></td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-outline-info"
                                                            x-on:click="select(index)">Edit</button>
                                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                                            x-on:click="remove(index)">X</button>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered pull-right" style="width: 40% !important;"
                                        align="right">
                                        <tr>
                                            <td>
                                                <h6>TOTAL</h6>
                                            </td>
                                            <td align="right" class="total_display"
                                                x-text="items.reduce((prev, item) => prev + (item.quantity * item.unit_price), 0)">
                                                .00</td>
                                        </tr>



                                    </table>
                                </div>

                                @isset($purchase)
                                    <button type="submit" class="btn btn-lg btn-primary">Update Purchase</button>
                                @else
                                    <button type="submit" class="btn btn-lg btn-primary">Create Purchase</button>
                                @endisset

                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const initialForm = {
            item: null,
            unit: null,
            inv_item_id: "",
            conf_unit_id: "",
            quantity: "",
            unit_price: "",
            vendor_id: "",
            batch: ""
        };

        function getState() {
            return {
                inventoryItems: [],
                units: [],
                active: -1,
                form: initialForm,
                items: [],
                vendors: [],
                initialize(items, units, vendors, payload) {
                    this.inventoryItems = items;
                    this.units = units;
                    this.vendors = vendors;

                    // edit form
                    console.log(payload);
                    for (var i = 0; i < payload.length; i++) {
                        const x = payload[i];
                        const __item = this.inventoryItems.find(i => i.id == x.inv_item_id);
                        const __unit = this.units.find(u => u.id == x.conf_unit_id);
                        const _itemPayload = {
                            ...x,
                            item: __item,
                            unit: __unit,
                        }
                        this.items.push(_itemPayload);
                    }

                    this.$watch('form.inv_item_id', id => {
                        const _item = this.inventoryItems.find(i => i.id == id);
                        console.log("inventory item id has changed", id, _item, this.inventoryItems);
                        if (_item) {
                            this.form.item = _item;
                        }
                    });
                    this.$watch('form.conf_unit_id', id => {
                        const _unit = this.units.find(u => u.id == id);
                        console.log("unit id has changed", id, _unit, this.units);
                        if (_unit) {
                            this.form.unit = _unit;
                        }
                    });
                },
                add() {
                    this.items.push(this.form);
                    this.form = {
                        item: null,
                        unit: null,
                        inv_item_id: "",
                        conf_unit_id: "",
                        quantity: "",
                        unit_price: "",
                        batch: ""
                    };
                    console.log("Add Triggred", this.form);
                },
                update() {
                    this.items[this.active] = this.form;
                    this.form = {
                        item: null,
                        unit: null,
                        inv_item_id: "",
                        conf_unit_id: "",
                        quantity: "",
                        unit_price: "",
                        batch: ""
                    };
                    this.active = -1;
                    console.log("Update Triggred", this.form);
                },
                select(index) {
                    this.active = index;
                    this.form = this.items[index];
                },
                remove(index) {
                    this.items.splice(index, 1);
                }
            }
        }
    </script>
@endsection
