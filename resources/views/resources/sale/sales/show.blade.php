@extends('layouts.app')

@section('page_title')
    {{ $sale->code }}
@endsection

@section('page_action')
    @if ($sale->status == 'DRAFT')
        <a href="{{ route('sale.sales.invoice', ['sale' => $sale, 'type' => 'Profroma']) }}" class="btn btn-outline-info"><i
                class="material-icons-outlined">file_download</i> Profroma </a>
        <a href="{{ route('sale.sales.edit', ['sale' => $sale]) }}" class="btn btn-primary"><i class="material-icons">edit</i>
            Edit</a>
    @else
        <a href="{{ route('sale.sales.invoice', ['sale' => $sale->id, 'type' => 'Invoice']) }}"
            class="btn btn-outline-danger">
            <i class="material-icons-outlined">file_download</i>
            Invoice</a>
    @endif
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Sale') }}</div>
                    <div class="card-body">
                        <div id="printJS-form">
                            <div class="row">
                                <div class="col-sm-4">
                                    From:
                                    <address>
                                        <strong>Company Name.</strong><br>
                                        @foreach ($organizations as $organization)
                                            <td>
                                                {{ $organization->name }}.<br />
                                                {{ $organization->phone }}<br />
                                                {{ $organization->address }}
                                            </td>
                                        @endforeach
                                        <b></b>
                                    </address>
                                </div>

                                <div class="col-sm-4">
                                    To:
                                    <address>
                                        <strong>Customer Name</strong><br>
                                        {{ $sale->customer->name }}.<br />
                                        {{ $sale->customer->phone }}<br />
                                        {{ $sale->Customer->email }}
                                    </address>
                                </div>

                                <div class="col-sm-4">
                                    <b>{{ $sale->code }}</b><br>
                                    <b>Date:</b> {{ $sale->date->format('d/m/Y') }}<br>
                                </div>

                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S/n</th>
                                        <th>sale code</th>
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
                                            <td>{{ $saleItem->sale->code }}</td>
                                            <td>{{ $saleItem->item->name }}</td>
                                            <td>{{ $saleItem->quantity }} {{ $saleItem->unit->code }}</td>
                                            <td>{{ number_format($saleItem->unit_price) }} TZS</td>
                                            <td align="right">{{ number_format($amount) }} TZS</td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th colspan="5">Total:</th>
                                        <td align="right">
                                            <h5>{{ number_format($total) }} TZS</h5>
                                        </td>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                        @if ($sale->status == 'DRAFT')
                            <form action="{{ route('sale.sales.submit', ['sale' => $sale]) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <br />
                                <button type="submit" class="btn btn-success float-left"><i class="material-icons">send</i>
                                    Submit Sale
                                </button>
                            </form>
                        @else
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
