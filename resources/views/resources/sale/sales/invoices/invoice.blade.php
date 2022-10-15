<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>A simple, clean, and responsive HTML invoice template</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }

        .mytable tbody td,
        thead th,
        tfoot th,
        tfoot td {
            border: 1px solid black;
            padding: 10px;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{ public_path('images/logo.png') }}" style="width: 100%; max-width: 300px" />
                            </td>

                            <td>
                                {{ $type }} No:# {{ rand(000, 999) }}<br />
                                Created: {{ $sale->date->format('d/m/Y') }}<br />

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>

                        <tr>

                            @foreach ($organizations as $organization)
                                <td>
                                    {{ $organization->name }}.<br />
                                    {{ $organization->phone }}<br />
                                    {{ $organization->address }}
                                </td>
                            @endforeach


                            <td>
                                To:<br />
                                {{ $sale->customer->name }}.<br />
                                {{ $sale->customer->phone }}<br />
                                {{ $sale->Customer->email }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>



        <table style="width:100%" class="mytable" cellspacing="0">
            <thead>
                <tr class="heading">
                    <th>S/n</th>
                    <th>Item</th>
                    <th>Quantinty</th>
                    <th>Unit Amount</th>
                    <th>Total Amount</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach ($sale->salesItems as $saleItem)
                    @php
                        $amount = $saleItem->unit_price * $saleItem->quantity;
                        $total += $amount;
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $saleItem->item->name }}</td>
                        <td>{{ $saleItem->quantity }} {{ $saleItem->unit->code }}</td>
                        <td>{{ number_format($saleItem->unit_price) }} TZS</td>
                        <td align="right">{{ number_format($amount) }} TZS</td>
                    </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <th colspan="4">Total:</th>
                    <td align="right">
                        <h5>{{ number_format($total) }} TZS</h5>
                    </td>
                </tr>
            </tfoot>

        </table>




    </div>
</body>

</html>
