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


            <h5 class="mt-3 mb-3">GROSS PROFIT REPORT</h5>

            <div class="row">
                <div class="col-md-5">
                    <table id="report-summary">
                        @if ($vendor)
                        <tr>
                            <td>Vendor Type</td>
                            <td>{{ $vendor }}</td>
                        </tr>
                        @else
                        <tr>
                            <td>Vendor Type</td>
                            <td>All</td>
                        </tr>
                        @endif
                        <tr>
                            <td>Date</td>
                            <td><strong>{{ $from }} To {{ $to }}</strong></td>
                        </tr>
                    </table>
                </div>
            </div>
            <br><br>
            <table>
  <tr>
    <th>Particular</th>
    <th>Debit</th>
    <th>Credit</th>
  </tr>
  <tr>
    <td>Total Purchases</td>
    <td></td>
    <td>{{number_format($total_purchase)}}</td>
  </tr>
  <tr>
    <td>Total Sales</td>
    <td>{{number_format($salesTotal)}}</td>
    <td></td>
  </tr>
  <tr>
    <td>Total Expenses</td>
    <td></td>
    <td>{{number_format($expenses)}}</td>
  </tr>
   <tr>
    <td   colspan="2"><b>Total Credit  Amout</b></td>
    <td><stong>{{number_format( $total_purchase + $expenses) }}</stong></td>
  </tr>
  <tr>
    <td colspan="2"><b>Gross profit  Amout</b></td>
    <td><stong>{{number_format( $salesTotal - ($total_purchase + $expenses)) }}</stong></td>
  </tr>

</table>

            
        </div>
    </div>
</body>

</html>
