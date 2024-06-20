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
                    <div class="card-header"></div>
                    <table class="table table-bordered" cellpadding="0" cellspacing="0">
                        
                               
                                    <tr>
                                       
                                            <td>
                                                Account Name: {{ $account->account_name }} <br />
                                                Account Type: {{ $account->account_type }}<br />
                                                Status: {{ $account->status }}<br />
                                            </td>
                                           
                                        
                                        <td>
                                            Credit Balance: {{  number_format($account->balance) }} <br />
                                            Debit Balance: {{  number_format($account->initial_balance) }}<br />
            
                                        </td>
                                        <td>
                                           
                                            
                                                {{ $account->customer->name }}.<br />
                                                {{ $account->customer->phone }}<br />
                                                {{ $account->Customer->email }}
                                           
                                        </td>
            
                                      
                                    </tr>
                                
                            
            
                       
                    </table>
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
                                @foreach ($accountLegders as $ledger)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$ledger->sale->code}}</td>
                                        <td>{{ $ledger->description }}</td>
                                        <td>{{ $ledger->created_at }}</td>
                                        <td>{{ $ledger->credit?  number_format($ledger->amount):"NULL" }}</td>
                                        <td>{{ $ledger->debit?  number_format($ledger->amount):"NULL" }}</td>

                                        
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
