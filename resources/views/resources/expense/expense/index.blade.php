@extends('layouts.app')
@section('page_title')
    {{ __('Expenses') }}
@endsection

@section('page_action')
    <a href="{{ route('expense.expenses.create') }}" class="btn btn-primary"><i class="material-icons">add</i> Add
        Expense</a>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"></div>

                    <div class="card-body table-responsive">

                        <table class="table table-stripped" id="example">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>User</th>
                                    <th>Date</th>
                                    <th width="100px">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($expenses as $expense)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $expense->expenseCategory->category_name }}</td>
                                        <td>{{ number_format($expense->amount) }}</td>
                                        <td>{{ $expense->user->name }}</td>
                                        <td>{{ $expense->created_at }}</td>
                                        {{-- <td>Action</td> --}}
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('expense.expenses.show', ['expense' => $expense]) }}"
                                                    class="btn btn-outline-success"><i
                                                        class="material-icons">visibility</i></a>
                                                <a href="{{ route('expense.expenses.edit', ['expense' => $expense]) }}"
                                                    class="btn btn-outline-info"><i class="material-icons">edit</i></a>
                                                <form action="{{ route('expense.expenses.destroy', ['expense' => $expense]) }}"
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
        new DataTable('#example');
    </script>
@endsection
