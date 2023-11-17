@extends('layouts.app')
@section('page_title')
    {{ __('Inventory Items Instock') }}
@endsection
@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><button type="button" class="btn btn-lg btn-primary" onclick="printableDiv('printableArea')" > <i class="material-icons-outlined">file_download</i> Print    </button></div>
                    <div class="card-body table-responsive">
                        <div id="printableArea">
                        <table   class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Name</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($stockItems as $stockItem)
                                  
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $stockItem->name }}</td>
                                        @foreach ($stockItem->warehouses as $stock)
                                             <td>{{ $stock->pivot->in_stock }}</td>
                                        @endforeach
                                       
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
    
@endsection
