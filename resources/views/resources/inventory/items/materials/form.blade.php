@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Quantity') }}</div>

                    <div class="card-body">

                        @isset($inventoryItemMaterial)
                            <form
                                action="{{ route('inventory.inventoryItems.inventoryItemMaterials.update', ['inventoryItem' => $inventoryItem, 'inventoryItemMaterial' => $inventoryItemMaterial]) }}"
                                method="POST" enctype="multipart/form-data">
                                @method('patch')
                            @else
                                <form
                                    action="{{ route('inventory.inventoryItems.inventoryItemMaterials.store', ['inventoryItem' => $inventoryItem]) }}"
                                    method="POST" enctype="multipart/form-data">
                                @endisset

                                @csrf
                                <input type="hidden" name="source_inv_items_id" value="{{ $inventoryItem->id }}">
                                <input type="hidden" name="material_inv_items_id" id=""
                                    value="{{ $inventoryItem->id }}">
                                <div class="form-group">
                                    <label for="" class="label-control">{{ __('Select material') }}</label>
                                    <select name="material_inv_items_id" id="material_inv_items_id"
                                        class="form-control @error('material_inv_items_id') is-invalid @enderror">
                                        <option value="">Choose...</option>
                                        @foreach ($inventoryItems as $inventorySelect)
                                            @if ($inventorySelect->id == $inventoryItem->id)
                                            @else
                                                <option
                                                    value="{{ $inventorySelect->id }}"{{ isset($inventorySelect) && $inventorySelect->id == $inventorySelect->id ? 'selected' : '' }}>
                                                    {{ $inventorySelect->name }} - {{ $inventorySelect->unit->code }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('material_inv_items_id')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                                <x-form.custom-input name="quantity" type="text" label="Quantity"
                                    placeholder="Enter Quantity"
                                    value="{{ isset($inventoryItemMaterial) ? $inventoryItemMaterial->quantity : null }}" />
                                <div class="form-group">
                                    <label for="" class="label-control">{{ __('Select Type') }}</label>
                                    <select name="type" id="type"
                                        class="form-control @error('type') is-invalid @enderror">
                                        <option value="">Choose...</option>
                                        <option
                                            value="RAW"{{ isset($inventoryItemMaterial) && $inventoryItemMaterial->type == 'RAW' ? 'selected' : '' }}>
                                            RAW</option>
                                        <option value="WASTAGE"
                                            {{ isset($inventoryItemMaterial) && $inventoryItemMaterial->type == 'WASTAGE' ? 'selected' : '' }}>
                                            WASTAGE</option>
                                    </select>
                                    @error('type')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>


                                <br />

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
