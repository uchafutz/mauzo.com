@extends('layouts.app')
@section('page_title')
    @isset($expense)
        Update Expense
    @else
        New Expense
    @endisset
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>

                    <div class="card-body">

                            @isset($expense)
                            <form action="{{ route('expense.expenseCategories.update', ['expenseCategory' => $category]) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                            @else
                                <form action="{{ route('expense.expenses.store') }}" method="POST" enctype="multipart/form-data">
                            @endisset

                                @csrf

                                <div>
                                    <label for="">Category</label>
                                    <select name="expense_category_id" id="" class="form-control @error('expense_category_id') is-invalid @enderror">
                                        <option value="">Choose category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <br>
                                <div>
                                    <label for="">Shop</label>
                                    <select name="inventory_warehouse_id" id="" class="form-control @error('inventory_warehouse_id') is-invalid @enderror">
                                        <option value="">Choose shop</option>
                                        @foreach ($warehouses as $warehouse)
                                        <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <br>
                                <div>
                                    <label for="" class="label-control">Type</label>
                                    <select name="type"
                                        class="form-control @error('type') is-invalid @enderror">
                                       <option value="">Choose vendor</option>
                                       <option value="local">Local</option>
                                       <option value="international">International</option>
                                       <option value="internal">Internal</option>
                                    </select>
                                </div>
                                <br>
                                <x-form.custom-input name="amount" type="text" label="Amount" placeholder=""
                                value="{{ isset($expense) ? $expense->amount : null }}" />

                                 <br />

                                <x-form.custom-textarea name="description" label="Description" placeholder="Description"
                                    value="{{ isset($expense) ? $expense->description : null }}" />

                                <br />


                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
