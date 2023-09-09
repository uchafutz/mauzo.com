@extends('layouts.app')
@section('page_title')
    {{ __('Expense Category List') }}
@endsection

@section('page_action')
    <a href="{{ route('expense.expenseCategories.create') }}" class="btn btn-primary"><i class="material-icons">add</i> Create
        Category</a>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"></div>

                    <div class="card-body">
                        <table id="expense-category-table" class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Name</th>
                                    <th width="100px">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $category->category_name }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('expense.expenseCategories.edit', ['expenseCategory' => $category]) }}"
                                                    class="btn btn-outline-primary"><i class="material-icons">edit</i></a>
                                                <form
                                                    action="{{ route('expense.expenseCategories.destroy', ['expenseCategory' => $category]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-outline-danger"><i
                                                            class="material-icons">delete_outline</i></button>
                                                </form>
                                            </div>
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
    <script>   	
        new DataTable('#expense-category-table');
    </script>
@endsection
