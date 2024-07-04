@extends('layouts.app')

@section('page_title')
  Account Ledgers
@endsection

@section('page_action')
    <a href="{{ route('account.accountLedgers.create') }}" class="btn btn-primary"><i class="material-icons">add</i> Create
        Transactions</a>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body table-responsive">
                        <table id="example" class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Operation</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Credit</th>
                                    <td>Debit</td>
                                   
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($accountLedgers as $ledger)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$ledger->sale?$ledger->sale->code:"NULL"}}</td>
                                        <td>{{ $ledger->description }}</td>
                                        <td>{{ $ledger->created_at }}</td>
                                        <td>{{ $ledger->credit?  number_format($ledger->amount):"NULL" }}</td>
                                        <td>{{ $ledger->debit?  number_format($ledger->amount):"NULL" }}</td>

                                        
                                    </tr>
                                @endforeach
                            </tbody>
                                        
                        </table>
                        {{ $accountLedgers->onEachSide(10)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        	
       // new DataTable('#example');
    </script>
@endsection
