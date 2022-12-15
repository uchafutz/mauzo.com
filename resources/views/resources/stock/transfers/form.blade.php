@extends('layouts.app')

@section('page_title')
    @isset($stokTransfer)
        Update Stock Transfer
    @else
        New Stock Transfer
    @endisset
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" x-data="getState()" x-init="initialize({{ json_encode($wareHouses) }}, {{ json_encode($units) }})">
                        @isset($stockTransfer)
                            <form class="row g-3"
                                action="{{ route('stock.stockTransfers.update', ['stockTranfer' => $stockTranfer]) }}"
                                method="POST" enctype="multipart/form-data">
                                @method('patch')
                            @else
                                <form class="row g-3" action="{{ route('stock.stockTransfers.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                @endisset
                                @csrf
                                <input type="hidden" name="operator_id" value="{{ Auth::user()->id }}" required>
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <label for="" class="label-control">From WareHouse</label>
                                            <select class="form-control" name="from_warehouse_id"
                                                x-model="form.from_warehouse_id">
                                                <option value="">Choose...</option>
                                                <template x-for="wareHouse in wareHouses">
                                                    <option x-bind:value="wareHouse.id" x-text="wareHouse.name"
                                                        x-bind:selected="wareHouse.id == form.from_warehouse_id"></option>
                                                </template>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="" class="label-control">To WareHouse</label>
                                            <select class="form-control" name="to_warehouse_id"
                                                x-model="form.to_warehouse_id">



                                            </select>
                                        </div>
                                        <div class="col">
                                            <x-form.custom-input type="date" name="date" label="Transfer Date"
                                                value="{{ isset($stockTransfer) ? $stockTransfer->date->format('Y-m-d') : date('Y-m-d') }}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <x-form.custom-textarea name="description" label="Description"
                                        value="{{ isset($stockTransfer) ? $stockTransfer->description : '' }}" />
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="" class="label-control">Inventory Item</label>
                                                <select class="form-control">
                                                    <option value="">Choose Item...</option>
                                                    <template>
                                                        <option></option>
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
                                                <input type="number" placeholder="Qty" max=""
                                                    class="quantity border form-control" x-model="form.quantity">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="" class="label-control">In Stock</label>
                                                <select class="form-control">
                                                    <option value="">Choose Stock item</option>
                                                    <template>
                                                        <option></option>
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
                                        <th>S/n</th>
                                        <th>Item</th>
                                        <th>Unit</th>
                                        <th>Quantity</th>
                                        <th>In Stock</th>
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


                                                <td x-text="index + 1"></td>
                                                <td x-text="item.item.name"></td>
                                                <td x-text="item.unit.name"></td>
                                                <td x-text="item.quantity"></td>
                                                <td x-text="item.stock"></td>
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


                                @isset($stockTransfer)
                                    <button type="submit" class="btn btn-lg btn-primary">Update Stock Transfer</button>
                                @else
                                    <button type="submit" class="btn btn-lg btn-primary">Create Stock Transfer</button>
                                @endisset

                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const initialForm = {
            from_warehouse_id = "",
            to_warehouse_id = "",
            warehouse: null,
            unit: null,

        };

        function getState() {
            return {
                units: [],
                warehouses: [],
                //item: {},
                form: initialForm,


                initialize(wareHouses, units) {
                    this.wareHouses = wareHouses;
                    this.units = units;
                    // this.item = item ?? {};
                    this.form.from_warehouse_id = from_warehouse_id;
                    this.form.to_warehouse_id = to_warehouse_id;






                },

            }
        }
    </script>
@endsection
