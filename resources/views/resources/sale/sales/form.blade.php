@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('New Sale') }}</div>
                    <div class="card-body" x-data="getState()" x-init="initialize({{ json_encode($items) }}, {{ json_encode($units) }}, {{ isset($sale) ? json_encode($sale->salesItems) : json_encode([]) }}, {{ isset($sale) ? json_encode($sale) : json_encode([]) }})">
                        @isset($sale)
                            <form class="row g-3" action="{{ route('sale.sales.update', ['sale' => $sale]) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('patch')
                            @else
                                <form class="row g-3" action="{{ route('sale.sales.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                @endisset
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <x-form.custom-input type="date" name="date" label="Sale Date"
                                            value="{{ isset($sale) ? $sale->date->format('Y-m-d') : date('Y-m-d') }}" />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="label-control" x-model="form.customer_id">Select
                                            customer</label>
                                        <select name="customer_id" class="form-control">
                                            <option value="1" selected>DEFAULT CUSTOMER</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <x-form.custom-textarea name="description" label="Sale Descriptin"
                                        value="{{ isset($sale) ? $sale->description : '' }}" />
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="" class="label-control">Inventory Item</label>
                                                <select class="form-control" x-model="form.inv_item_id">
                                                    <option value="">Choose Item...</option>
                                                    <template
                                                        x-for="item in inventoryItems.filter(i => !items.find(it => it.inv_item_id == i.id))">
                                                        <option x-bind:value="item.id" x-text="item.name"></option>
                                                    </template>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="" class="label-control">Unit of Meansure</label>
                                                <select class="form-control" x-model="form.conf_unit_id">
                                                    <option value="">Choose Unit</option>
                                                    <template
                                                        x-for="item in units.filter(u => form.item ? u.unit_type_id == form.item.unit_type_id : true)">
                                                        <option x-bind:value="item.id" x-text="item.name"></option>
                                                    </template>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="" class="label-control">Quantity</label>
                                                <input type="number" placeholder="Qty" class="quantity border form-control"
                                                    x-model="form.quantity">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="" class="label-control">Selling Price</label>
                                                <input type="number" placeholder="Unit Amount" x-model="form.sale_price"
                                                    class="quantity border form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="" class="label-control">Stock Item</label>
                                                <select class="form-control" x-model="form.inv_stock_item_id">
                                                    <option value="">Choose warehouse...</option>
                                                    <template x-for="stock in form.item.stock_items">
                                                        <option x-bind:value="stock.id">
                                                            <span x-text="stock.warehouse.name"></span>
                                                            <ul>
                                                                <li>"<span x-text="stock.quantity"></span></li>
                                                                <li>"<span x-text="stock.unit_cost"></span></li>
                                                            </ul>
                                                        </option>
                                                    </template>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
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
                                    </div>
                                </div>

                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <th>Item</th>
                                        <th>Unit</th>
                                        <th>Quantity</th>
                                        <th>Stock Item</th>
                                        <th>In Stock</th>
                                        <th>Buying Price</th>
                                        <th>Selling Price</th>
                                        <th>Margin</th>
                                        <th></th>
                                    </tr>
                                    <tbody>
                                        <template x-for="(item, index) in items">
                                            <tr>
                                                @isset($sale)
                                                    <input type="hidden" x-bind:name="'items[' + index + '][id]'"
                                                        x-bind:value="item.id">
                                                @endisset

                                                <input type="hidden" x-bind:name="'items[' + index + '][inv_item_id]'"
                                                    x-bind:value="item.inv_item_id">
                                                <input type="hidden" x-bind:name="'items[' + index + '][conf_unit_id]'"
                                                    x-bind:value="item.conf_unit_id">
                                                <input type="hidden" x-bind:name="'items[' + index + '][quantity]'"
                                                    x-bind:value="item.quantity">
                                                <input type="hidden" x-bind:name="'items[' + index + '][unit_price]'"
                                                    x-bind:value="item.sale_price">
                                                <input type="hidden"
                                                    x-bind:name="'items[' + index + '][inv_stock_item_id]'"
                                                    x-bind:value="item.inv_stock_item_id">

                                                <td x-text="item.item.name"></td>
                                                <td x-text="item.unit.name"></td>
                                                <td x-text="item.quantity"></td>
                                                <td x-text="item.stock_item.warehouse.name"></td>
                                                <td x-text="item.stock_item.in_stock"></td>
                                                <td x-text="item.stock_item.unit_cost"></td>
                                                <td x-text="item.sale_price"></td>
                                                <td x-text="item.sale_price - item.stock_item.unit_cost"></td>
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
                                <table class="table table-bordered pull-right" style="width: 40% !important;"
                                    align="right">
                                    <tr>
                                        <td>
                                            <h6>TOTAL</h6>
                                        </td>
                                        <td class="total_display" x-text="total">.00</td>
                                        <input type="hidden" name="total_amount" x-bind:value="total">
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>RECEIVED </h6>
                                        </td>
                                        <td><input type="number" name="received_amount" x-model="received_amount"
                                                value="{{ isset($sale) ? $sale->received_amount : '' }}"
                                                class="form-control" required></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>RETURN</h6>
                                        </td>
                                        <td x-text="received_amount - total">.00</td>
                                        <input type="hidden" name="return_amount" x-bind:value="received_amount - total"
                                            class="form-control" readonly>
                                    </tr>


                                </table>


                                @isset($sale)
                                    <button type="submit" class="btn btn-lg btn-primary">Update sale</button>
                                @else
                                    <button type="submit" class="btn btn-lg btn-danger">Create sale</button>
                                @endisset

                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const initialForm = {
            stock_item: null,
            item: null,
            unit: null,
            inv_item_id: "",
            conf_unit_id: "",
            quantity: "",
            sale_price: "",
            inv_stock_item_id: "",

        };

        function getState() {
            return {
                inventoryItems: [],
                units: [],
                active: -1,
                form: initialForm,
                items: [],
                customers: [],
                total: 0,
                received_amount: 0,
                sale: {},

                initialize(items, units, payload, sale) {
                    this.inventoryItems = items;
                    this.units = units;
                    this.sale = sale;

                    if (sale != null) {
                        this.received_amount = sale.received_amount;

                    }
                    // edit form
                    for (var i = 0; i < payload.length; i++) {
                        const x = payload[i];
                        const __item = this.inventoryItems.find(i => i.id == x.inv_item_id);
                        const __unit = this.units.find(u => u.id == x.conf_unit_id);
                        const __stock_item = __item.stock_items.find(i => i.id == x.inv_stock_item_id)
                        const _itemPayload = {
                            ...x,
                            sale_price: x.unit_price,
                            item: __item,
                            unit: __unit,
                            stock_item: __stock_item,
                        }
                        this.items.push(_itemPayload);
                    }
                    if (payload.length > 0) {
                        this.updateTotal();
                    }

                    this.$watch('form.inv_item_id', id => {
                        const _item = this.inventoryItems.find(i => i.id == id);
                        console.log("inventory item id has changed", id, _item, this.inventoryItems);
                        if (_item) {
                            this.form.item = _item;
                            this.form.sale_price = _item.sale_price
                        }
                    });
                    this.$watch('form.conf_unit_id', id => {
                        const _unit = this.units.find(u => u.id == id);
                        console.log("unit id has changed", id, _unit, this.units);
                        if (_unit) {
                            this.form.unit = _unit;
                        }
                    });
                    this.$watch('form.inv_stock_item_id', id => {
                        const _stockItem = this.form.item.stock_items.find(i => i.id == id);
                        console.log("stock item id has changed", id, _stockItem);
                        if (_stockItem) {
                            this.form.stock_item = _stockItem;
                        }
                    });

                },
                updateTotal() {
                    const _total = this.items.reduce((prev, item) => prev + (item.quantity * item.sale_price), 0);
                    this.total = _total;
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
                    };
                    console.log("Add Triggred", this.form);
                    this.updateTotal();

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
                    };
                    this.active = -1;
                    console.log("Add Triggred", this.form);
                    this.updateTotal();
                },
                select(index) {
                    this.active = index;
                    this.form = this.items[index];
                },
                remove(index) {
                    this.items.splice(index, 1);
                    this.updateTotal();
                }
            }
        }
    </script>
@endsection
