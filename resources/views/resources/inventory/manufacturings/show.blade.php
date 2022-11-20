@extends('layouts.app')

@section('page_title')
    {{ $manufacturing->item->name . ' M' . str_pad($manufacturing->id, 3, "0", STR_PAD_LEFT) }}
@endsection

@section('page_action')
    @if ($manufacturing->status == 'DRAFT')
        <a href="{{ route("inventory.manufacturings.edit", ["manufacturing" => $manufacturing]) }}" class="btn btn-primary"><i class="material-icons">edit</i> Edit</a>
    @endif
    @if ($manufacturing->status == 'BOQ')
        <form action="{{ route('inventory.manufacturings.submit', ['manufacturing' => $manufacturing]) }}" method="post">
            @csrf
            <button type="submit" class="btn btn-success btn-lg"><i class="material-icons">send</i> Submit</button>
        </form>
    @endif
@endsection

@section('content')
    <div class="container" x-data="getModalState()">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="d-flex mb-2">
                    <div class="flex-grow-1"></div>
                    @if ($manufacturing->status == 'CREATED')
                        <form
                            action="{{ route('inventory.manufacturings.generateBOQ', ['manufacturing' => $manufacturing]) }}"
                            method="post">
                            @csrf
                            <button class="btn btn-lg btn-primary">Generate BOQ</button>
                        </form>
                    @endif
                </div>
               <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Manufacturing Details</h3>
                    <table class="table">
                        <tr>
                            <th>Item</th>
                            <td><a href="{{ route("inventory.inventoryItems.show", ['inventoryItem' => $manufacturing->item]) }}">{{ $manufacturing->item->name }}</a></td>
                        </tr>
                        <tr>
                            <th>Quantity</th>
                            <td>{{ $manufacturing->quantity }} {{ $manufacturing->unit->code }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                {{ $manufacturing->status }}
                            </td>
                        </tr>
                        <tr>
                            <th>Warehouse</th>
                            <td>
                                {{ $manufacturing->warehouse->name }}
                            </td>
                        </tr>
                    </table>
                </div>
               </div>

               <div class="row mt-2">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Raw Materials</h5>
                            <p>The raw materials required to produce 1 {{ $manufacturing->item->unit->code }}</p>
                            <table class="table">
                                <thead>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                </thead>

                                <tbody>
                                    @foreach ($manufacturing->item->materials as $material)
                                        @if ($material->type == "RAW")
                                            <tr>
                                                <td>{{ $material->materialItem->name }}</td>
                                                <td>{{ $material->quantity }} {{ $material->materialItem->unit->code }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Waste</h5>
                            <p>The waste materials generated while producing 1 {{ $manufacturing->item->unit->code }}</p>
                            <table class="table">
                                <thead>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                </thead>

                                <tbody>
                                    @foreach ($manufacturing->item->materials as $material)
                                        @if ($material->type == "WASTAGE")
                                            <tr>
                                                <td>{{ $material->materialItem->name }}</td>
                                                <td>{{ $material->quantity }} {{ $material->materialItem->unit->code }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @if ($manufacturing->status != 'CREATED')
                    <div class="row mt-2">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Bill of Quantinty</h3>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <th>s/n</th>
                                                <th>Material</th>
                                                <th>Material Type</th>
                                                <th>Quantinty</th>
                                                <th>Current Stock</th>
                                                <th>Actions</th>
                                            </thead>
    
                                            <tbody>
                                                @foreach ($manufacturing->materials as $material)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $material->material->materialItem->name }}</td>
                                                        <td>{{ $material->material->type }}</td>
                                                        <td>{{ $material->quantity }}
                                                            {{ $material->material->materialItem->unit->code }}</td>
                                                        <td>{{ $material->material->materialItem->in_stock }}
                                                            {{ $material->material->materialItem->unit->code }} <sup
                                                                class="{{ $material->material->type == 'RAW' ? 'text-danger' : 'text-success' }}">
                                                                {{ $material->material->type == 'RAW' ? '-' : '+' }}{{ $material->quantity }}
                                                                {{ $material->material->materialItem->unit->code }}</sup> </td>
                                                        <td>
                                                            @if ($material->material->type == 'RAW' && $material->stockItems->count() == 0)
                                                                <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal"
                                                                    x-on:click="setValues(
                                                                        '{{ route('inventory.manufacturings.materials.assignStock', ['manufacturing' => $manufacturing, 'manufacturingMaterial' => $material]) }}', 
                                                                        '{{ $material->quantity }}', 
                                                                        {!! json_encode($material->material->materialItem->stockItems()->with('warehouse')->get()) !!}
                                                                    )">Assign
                                                                    Stock</button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
         <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <form x-bind:action="url" method="post" x-ref="form">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Assign Stock Items</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div x-show="error" class="alert alert-danger alert-style-light">
                                Sorry, Quantity Required and Quantity Contributed have not balanced
                            </div>
                        <h5>Total Quantity Required: <span x-text="quantity_required"></span></h5>
                        <h5 class="text-green">Total Quantity Contributed: <span x-text="stock_items.reduce((c, i) => c + parseInt(i.contribution),0)"></span></h5>
                        <table class="table">
                            <thead>
                                <th>S/N</th>
                                <th>Date</th>
                                <th>Unit Cost</th>
                                <th>Warehouse</th>
                                <th>In Stock</th>
                                <th>Contribution</th>
                            </thead>

                            <tbody>
                                <template x-for="(item, i) in stock_items">
                                    <tr>
                                        <td x-text="i+1"></td>
                                        <td x-text="item.created_at"></td>
                                        <td x-text="item.unit_cost"></td>
                                        <td x-text="item.warehouse.name"></td>
                                        <td x-text="item.in_stock"></td>
                                        <td>
                                            <input type="hidden" x-bind:name="item.stock_item_name" x-bind:value="item.id">
                                            <input type="number" class="form-control" x-bind:name="item.contribution_name" x-bind:max="item.in_stock" x-model="stock_items[i].contribution">
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button x-on:click.prevent="submit()" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function getModalState() {
            return {
                url: "",
                quantity_required: 0,
                stock_items: [],
                payload: [],
                error: false,
                setValues(url, quantity_required, stock_items, payload) {
                    this.url = url;
                    this.quantity_required = quantity_required;
                    this.payload = payload;
                    const _items = stock_items.map((i, index) => {
                        _payload = payload && payload.find(sitem => sitem.id == i.id);
                        return {
                            ...i, 
                            "contribution": _payload ? _payload.pivot.quantity : 0,
                            "stock_item_name": "items[:i][stock_item_id]".replace(':i', index),
                            "contribution_name": "items[:i][quantity]".replace(':i', index),
                        };
                        
                    });
                    console.debug(_items);
                    this.stock_items = _items
                    
                    this.stock_items.map((i, index) => {
                        let _should_watch = 'stock_items[:i].contribution'.replace(":i", index);
                        this.$watch(_should_watch, (value) => {
                            if (value > stock_items[index].in_stock) {
                                this.stock_items[index].contribution = stock_items[index].in_stock;
                            }
                        });
                    });
                },
                submit() {
                    let items_contributed = this.stock_items.reduce((c, i) => c + parseInt(i.contribution),0)
                    if (items_contributed != this.quantity_required) {
                        this.error = true;
                        setTimeout(() => {
                            this.error = false;
                        }, 10000);
                        return;
                    }
                    this.$refs.form.submit();
                }
            }
        }
    </script>
@endsection
