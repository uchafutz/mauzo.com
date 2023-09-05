@extends('layouts.app')

@section('page_title')
    Purchases
@endsection

@section('page_action')
    <a href="{{ route('purchase.purchases.create') }}" class="btn btn-primary"><i class="material-icons">add</i> Create
        Purchase</a>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <table id="example" class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Code</th>
                                    <th>Operator</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Description</th>

                                    <th width="100px">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($purchases as $purchase)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $purchase->code }}</td>
                                        <td>{{ $purchase->users->name ?? null }}</td>
                                        <td>{{ $purchase->date }}</td>
                                        <td>{{ $purchase->status }}</td>
                                        <td>{{ $purchase->description }}</td>

                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                @if ($purchase->status == 'SUBMITED')
                                                    <a href="{{ route('purchase.purchases.show', ['purchase' => $purchase]) }}"
                                                        class="btn btn-outline-success"><i
                                                            class="material-icons">visibility</i></a>
                                                @else
                                                    <a href="{{ route('purchase.purchases.show', ['purchase' => $purchase]) }}"
                                                        class="btn btn-outline-success"><i
                                                            class="material-icons">visibility</i></a>
                                                    <a href="{{ route('purchase.purchases.show', ['purchase' => $purchase]) }}"
                                                        class="btn btn-outline-primary"><i
                                                            class="material-icons">edit</i></a>

                                                    <form
                                                        action="{{ route('purchase.purchases.destroy', ['purchase' => $purchase]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')

                                                        <button type="submit" class="btn btn-outline-danger"><i
                                                                class="material-icons">delete_outline</i></button>
                                                    </form>
                                                @endif
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
