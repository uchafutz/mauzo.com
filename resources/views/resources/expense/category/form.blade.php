@extends('layouts.app')
@section('page_title')
    @isset($category)
        Update Category
    @else
        New Category
    @endisset
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>

                    <div class="card-body">

                            @isset($category)
                            <form action="{{ route('expense.expenseCategories.update', ['expenseCategory' => $category]) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                            @else
                                <form action="{{ route('expense.expenseCategories.store') }}" method="POST" enctype="multipart/form-data">
                            @endisset

                                @csrf

                                <x-form.custom-input name="category_name" type="text" label="Category Name" placeholder="Category name"
                                    value="{{ isset($category) ? $category->category_name : null }}" />
                                <br />


                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
