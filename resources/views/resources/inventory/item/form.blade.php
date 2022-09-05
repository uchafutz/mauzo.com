@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add inventoryItem') }}</div>

                    <div class="card-body">
                       
                        @isset($inventoryItem)
                            <form action="{{ route("inventory.inventoryItems.update", ["inventoryItem" => $inventoryItem]) }}" method="POST" enctype="multipart/form-data">
                                @method("patch")
                        @else
                            <form action="{{ route("inventory.inventoryItems.store") }}" method="POST" enctype="multipart/form-data">
                        @endisset
                        
                            @csrf
                             
                               <x-form.customerinput name="name" type="text" label="Name" placeholder="Enter name" value="{{ isset($inventoryItem)? $inventoryItem->name:null  }}"/>
                               <div class="form-group">
                                <label for="" class="label-control">Select Unit type</label>
                                <select name="unit_type_id" id="unit_type_id" class="form-control  @error('unit_type_id') is-invalid @enderror">
                                    <option value=""></option>
                                    @foreach ($unitTypes as $unitType)
                                    <option value="{{$unitType->id}}">{{$unitType->name}}</option>
                                    @endforeach
                                    
                                </select>
                               </div>

                               <x-form.customer-textarea name="description" label="Description" placeholder="Description" value="{{ isset($inventoryItem)?$inventoryItem->description : null}}"/>
                               <div class="form-group">
                                <label for="" class="label-control">Select Inventory category</label>
                                <select name="inventory_category_id" id="inventory_category_id" class="form-control  @error('inventory_category_id') is-invalid @enderror">
                                    @foreach ($inventoryCategories as $invetoryCategory)
                                    <option value="{{$invetoryCategory->id}}">{{$invetoryCategory->name}}</option>
                                    @endforeach
                                    
                                </select>
                               </div>
                               <x-form.customerinput name="featured_image" type="file" label="Choose file" placeholder="Choose file" value="{{ isset($inventoryItem)?$inventoryItem->featured_image : null  }}"/>
                               <x-form.customerinput name="reorder" type="text" label="Re order" placeholder="Enter Order" value="{{ isset($inventoryItem)? $inventoryItem->reorder :null }}"/>
                               <x-form.customerinput name="in_stock" type="text" label="Stock item" placeholder="Enter stock item" value="{{ isset($inventoryItem) ? $inventoryItem->in_stock : null }}"/>
                               <br/>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection