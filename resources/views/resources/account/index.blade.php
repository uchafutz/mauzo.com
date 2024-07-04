@extends('layouts.app')

@section('page_title')
  Accounts
@endsection

@section('page_action')
    {{-- <a href="{{ route('stock.accounts.create') }}" class="btn btn-primary"><i class="material-icons">add</i> Create
        Account</a> --}}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        
                    </div>
                   
                    <div class="card-body table-responsive">
                        <table id="example" class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Account Name</th>
                                    <th>Credit Balance</th>
                                    <th>Debit Balance</th>
                                    <th>Status</th>
                                    <th width="100px">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($accounts as $account)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $account->account_name }}</td>
                                        <td>{{  number_format($account->balance) }}</td>
                                        <td>{{  number_format($account->initial_balance) }}</td>
                                        <td>{{ $account->status }}</td>
                                        

                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                               
                                                    <a href="{{ route('account.accounts.show', ['account' => $account]) }}"
                                                        class="btn btn-outline-success"><i
                                                            class="material-icons">visibility</i></a>
                                                   

                                                    <form
                                                        action="{{ route('account.accounts.destroy', ['account' => $account]) }}"
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
