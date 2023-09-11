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


            <h5 class="mt-3 mb-3">PURCHASE REPORT</h5>

            <div class="row">
                <div class="col-md-5">
                    <table id="report-summary">
                        <tr>
                            <td>Vendor</td>
                            <td><strong>{{ count($purchases) > 0 ? $purchases[0]->vendors->name : '' }}</strong></td>
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
                        <th>Date</th>
                        <th>Employee</th>
                        <th>Item</th>
                        <th>Quantinty</th>
                        <th>Unit Amount</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                @php
                    $total_value = 0;
                    $sn = 1;
                @endphp
                <tbody>
                    @foreach ($purchases as $purchase)
                        @foreach ($purchase->items as $purchaseItem)
                            @php
                                $total = 0;
                                $amount = $purchaseItem->unit_price * $purchaseItem->quantity;
                                $total += $amount;
                            @endphp
                            <tr>
                                <td>{{ $sn++ }}</td>
                                <td>{{ $purchase->code }}</td>
                                <td>{{ $purchaseItem->created_at }}</td>
                                <td>{{ $purchase->users->name }}</td>
                                <td>{{ $purchaseItem->inventoryItem->name }}</td>
                                <td>{{ $purchaseItem->quantity }} {{ $purchaseItem->unit->code }}</td>
                                <td>{{ number_format($purchaseItem->unit_price) }}/=</td>
                                <td align="right">{{ number_format($amount) }}/=</td>
                            </tr>
                            @php
                                $total_value += $total;
                            @endphp
                        @endforeach
                    @endforeach
                </tbody>
            </table>

            <div class="total_col">
                TOTAL: <span><strong>{{ number_format($total_value) }}/=</strong></span>
            </div>

        </div>
    </div>
</body>

</html>
