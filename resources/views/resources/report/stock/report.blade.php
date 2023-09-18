<!DOCTYPE html>
<html>

<head>
    <title>Purchase Report</title>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

    <link href="https://printjs-4de6.kxcdn.com/print.min.css
" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        table,
        td,
        th {
            border: 1px solid #484646;
            text-align: left;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        #report-summary {
            width: 50%;
        }

        th,
        td {
            padding: 15px;
            text-align: right;
        }

        .total_col {
            float: right;
            margin-top: 20px;
        }

        h5 {
            text-align: center
        }

        @page {
            size: A4 landscape;
        }
    </style>

</head>

<body>


    <div class="row">
        <div class="col">


            <h5 class="mt-3 mb-3">AVAILABLE STOCK REPORT</h5>

            <div class="row">
                <div class="col-md-5">
                    <table id="report-summary">
                        
                        @if (!Auth::user()->is_admin)
                        <tr>
                            <td>STORE NAME</td>
                            <td>{{$warehouse->name}}</td>
                        </tr> 
                        @endif
                      
                        <tr>
                            <td>Date</td>
                            <td><strong>{{  date('Y-m-d H:i:s') }} </strong></td>
                        </tr>
                    </table>
                </div>
            </div>
            <br><br>
                    <table>
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>Name</th>
                                    <th>Stock</th>
                                    @if (!Auth::user()->is_admin)
                                        <th>Available</th>        
                                    @endif
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($inventoryItems as $inventoryItem)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        </td>
                                        <td>{{ $inventoryItem->name }}</td>
                                        
                                        <td class="{{ $inventoryItem->in_stock > $inventoryItem->reorder_level ? 'text-success' : 'text-danger' }}" >{{ $inventoryItem->in_stock ?? 0 }} {{ $inventoryItem->unit->code ?? null}}</td>
                                        
                                        @if (!Auth::user()->is_admin)
                                        <td>
                                          
                                            @php
                                                  foreach ( $inventoryItem->stockItems as $stockItem ){
                                                      if($stockItem->warehouse->id == $warehouse->id){
                                                             echo ($stockItem->in_stock);
                                                      }
                                                     }
                                            @endphp
                                             
                                             {{ $inventoryItem->unit->code ?? null}} 
                                          </td>  
                                        @endif
                                      
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
   

            
        </div>
    </div>
</body>

</html>
