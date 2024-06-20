<!DOCTYPE html>
<html>

<head>
    <title>Customer Report</title>
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


            <h5 class="mt-3 mb-3">CUSTOMER REPORT</h5>

            <div class="row">
                <div class="col-md-5">
                    <table id="report-summary">
                      
                        <tr>
                        <td>
                        <address>
                            <strong>Customer Details</strong><br>
                            
                                {{ $customer->name }}.<br />
                                {{ $customer->phone }}<br />
                                {{ $customer->email }}
                          
                        </address>
                         </td>
                         <td></td>
                        </tr>
                        
                        <tr>
                            <td>Date</td>
                            <td><strong>{{ $from }} To {{ $to }}</strong></td>
                        </tr>
                    </table>
                </div>
            </div>
            <br><br>
            <table>
       <thead>
        <tr>
            <th>S/n</th>
            <th>Code</th>
            <th>Operator</th>
            <th>Total</th>
          
        </tr>
       </thead>
       <tbody>
        @foreach ($sales as $sale)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $sale->code }}</td>
            <td>{{ $sale->users->name ?? null }}</td>
            <td>{{ number_format($sale->total_amount, null, null, ' ') }} TZS</td>
            
        </tr>
        @endforeach

       </tbody>
    

 
  
  <tr>
    <td colspan="3"><b>Total Sales</b></td>
    <td><stong>{{number_format( $salesTotal) }}</stong></td>
  </tr>

</table>

            
        </div>
    </div>
</body>

</html>
