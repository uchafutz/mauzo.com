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
                        <button type="button" class="btn btn-lg btn-primary" onclick="printableDiv('printableArea')" > <i class="material-icons-outlined">file_download</i> Print    </button>
                    </div>
                    <div id="printableArea">
                        <div class="card">
                            <div class="card-body">
                    <table class="table table-bordered" cellpadding="1" cellspacing="1">
                        
                               
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
                                   </div>
                                  </div>
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
                                        <td>{{$ledger->sale?$ledger->sale->code:"NULL"}}</td>
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
    </div>
    <script>
        function printableDiv(printableAreaDivId) {
     var printContents = document.getElementById(printableAreaDivId).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
    }
    </script>
    {{-- <script>
        	
        new DataTable('#example');
    </script> --}}
@endsection
