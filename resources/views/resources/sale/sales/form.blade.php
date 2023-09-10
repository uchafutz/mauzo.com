@extends('layouts.app')

@section('page_title')
    @isset($sale)
        Update Sale - {{ $sale->code }}
    @else
        New Sale
    @endisset
@endsection

@section('content')
    @isset($sale)
        <form class="row g-3" action="{{ route('sale.sales.update', ['sale' => $sale]) }}" method="POST"
            enctype="multipart/form-data">
            @method('patch')
        @else
            <form class="row g-3" action="{{ route('sale.sales.store') }}" method="POST" enctype="multipart/form-data">
            @endisset
            @csrf
            {{-- {!! dump(old('items') ? json_encode(old('items')) : null) !!} --}}
            <div class="container" x-data="getState()" x-init="initialize({{ json_encode($items) }}, {{ json_encode($units) }}, {{ isset($sale) && !old('items')? json_encode($sale->salesItems()->with('stockItems')->get()): (old('items')? json_encode(old('items')): json_encode([])) }}, {{ isset($sale) ? json_encode($sale) : null }})">
                @if ($errors->any())
                    <div class="row">
                        <div class="col-lg-12">
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-style-light" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                            </ul>
                        </div>
                @endif

                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="" class="label-control">Inventory Item</label>
                                        <select class="form-control" x-model="form.inv_item_id">
                                            <option value="">Choose Item...</option>
                                            <template
                                                x-for="item in inventoryItems.filter(i => !items.find(it => it.inv_item_id == i.id))">
                                                <option x-bind:value="item.id" x-text="item.name"></option>
                                            </template>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
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
                                    <div class="col-md-6">
                                        <label for="" class="label-control">Stock Item</label>
                                        <select class="form-control" x-model="form.inv_stock_item_id">
                                            <option value="">Choose warehouse...</option>
                                            <template x-for="stock in form.item.stock_items">
                                                <option x-bind:value="stock.id">
                                                    <span x-text="stock.warehouse.name"></span>
                                                    <ul>
                                                        <li>instock: <span x-text="form.unit ? stock.in_stock / form.unit.factor : stock.in_stock"></span>,</li>
                                                        <li>cost: <span x-text="form.unit ? stock.unit_cost * form.unit.factor : stock.unit_cost"></span></li>
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

                        <div class="card mt-2">
                            <div class="card-header">{{ __('New Sale') }}</div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <th>Item</th>
                                        <th>Unit</th>
                                        <th>Quantity</th>
                                        <th class="text-nowrap">Stock Item</th>
                                        <th class="text-nowrap">In Stock</th>
                                        <th class="text-nowrap">Buying Price</th>
                                        <th class="text-nowrap">Selling Price</th>
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
                                                <input type="hidden"
                                                    x-bind:name="'items[' + index + '][inv_stock_item_in_stock]'"
                                                    x-bind:value="item.stock_item.in_stock">

                                                <td class="text-nowrap" x-text="item.item.name"></td>
                                                <td class="text-nowrap" x-text="item.unit.name"></td>
                                                <td x-text="item.quantity"></td>
                                                <td class="text-nowrap" x-text="item.stock_item.warehouse.name"></td>
                                                <td x-text="item.stock_item.in_stock/item.unit.factor"></td>
                                                <td x-text="item.stock_item.unit_cost*item.unit.factor"></td>
                                                <td x-text="item.sale_price"></td>
                                                <td x-text="(item.sale_price - item.stock_item.unit_cost*item.unit.factor)"></td>
                                                <td class="d-flex">
                                                    <button type="button" class="btn btn-sm btn-outline-info mr-2"
                                                        x-on:click="select(index)">Edit</button>
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                        x-on:click="remove(index)">X</button>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                                {{-- <table class="table table-bordered pull-right" style="width: 40% !important;"
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


                                    </table> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" required>
                                    <div class="col-md-12">
                                        <x-form.custom-input type="date" name="date" label="Sale Date"
                                            value="{{ isset($sale) ? $sale->date->format('Y-m-d') : date('Y-m-d') }}" />
                                    </div>
                                    <div class="col-md-12">
                                        <label for="" class="label-control" x-model="form.customer_id">Select
                                            customer</label>
                                        <select name="customer_id" class="form-control">
                                            <option value="1" selected>DEFAULT CUSTOMER</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-12">
                                        <x-form.custom-textarea name="description" label="Sale Description"
                                            value="{{ isset($sale) ? $sale->description : '' }}" />
                                    </div>
                                    <div class="col-md-12">
                                        <x-form.custom-input type="text" name="received_amount"
                                            label="Received Amount" x-model="received_amount" x-init="received_amount = {{ old('received_amount') }}" />
                                    </div>

                                </div>

                                <input type="hidden" name="total_amount" x-bind:value="total">
                                <input type="hidden" name="return_amount" x-bind:value="received_amount - total">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Sale on Credit
                                    </label>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-lg-12">
                                        @isset($sale)
                                            <button type="submit" class="btn btn-lg btn-primary d-block">Update sale</button>
                                        @else
                                            <button type="submit" class="btn btn-lg btn-success d-block">Create sale</button>
                                        @endisset
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <div class="">
                                            <h6>TOTAL</h6>
                                            <h3 x-text="total + ' TZS'"></h3>
                                        </div>
                                    </div>
                                </div>

                                <div x-show="(received_amount - total) >= 0" class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="">
                                            <h6>RECEIVED</h6>
                                            <p class="text-success lead" x-text="received_amount + ' TZS'"></p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="">
                                            <h6>CHANGE</h6>
                                            <p class="text-danger lead" x-text="(received_amount - total) + ' TZS'"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script>
            const initialForm = {
                stock_item: null,
                item: {},
                unit: {},
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
                        // console.log(sale);
                        this.inventoryItems = items;
                        this.units = units;
                        this.sale = sale;

                        if (sale != null) {
                            this.received_amount = sale.received_amount;
                        }

                        // edit form
                        console.debug('payload', payload)
                        for (var i = 0; i < payload.length; i++) {
                            const x = payload[i];
                            console.debug('debugging', x);
                            const __item = this.inventoryItems.find(i => i.id == x.inv_item_id);
                            console.debug('__item', __item);
                            const __unit = this.units.find(u => u.id == x.conf_unit_id);
                            console.debug('__unit', JSON.stringify(__unit));
                            console.debug('__item.stock_items', __item.stock_items)
                            const __stock_item = __item.stock_items.find(i => {
                                if (i.id == x.inv_stock_item_id) {
                                    console.debug("result obtained from process 1");
                                    return i.id == x.inv_stock_item_id;
                                }
                                if (x.stock_items) {
                                    if (x.stock_items.length > 0) {
                                        console.debug("result obtained from process 2");
                                        return i.id == x.stock_items[0].stock_item_id;
                                    }
                                }
                            })
                            console.debug('__stock_item', JSON.stringify(__stock_item));
                            const _itemPayload = {
                                ...x,
                                sale_price: x.unit_price,
                                inv_stock_item_id: __stock_item.id,
                                item: __item,
                                unit: __unit,
                                stock_item: __stock_item,
                            }
                            this.items.push(_itemPayload);
                        }

                        console.debug("Finished the for loop");
                        if (payload.length > 0) {
                            console.debug("Updating Total from the Payload");
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
                                this.form.sale_price = this.form.item.sale_price * _unit.factor;
                            }
                            
                        });

                        this.$watch('form.inv_stock_item_id', id => {
                            if (!this.form.item) return;
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
