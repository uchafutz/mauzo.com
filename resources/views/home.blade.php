@extends('layouts.app')

@section('header')
    <div class="row">
        <div class="col">
            <div class="page-description d-flex align-items-center">
                <div class="page-description-content flex-grow-1">
                    <h1>Dashboard</h1>
                </div>
                {{-- <div class="page-description-actions">
                    <a href="#" class="btn btn-info btn-style-light"><i
                            class="material-icons-outlined">file_download</i>Download</a>
                    <a href="#" class="btn btn-warning btn-style-light"><i class="material-icons">add</i>Create</a>
                </div> --}}
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xl-4">
            <div class="card widget widget-stats">
                <div class="card-body">
                    <div class="widget-stats-container d-flex">
                        <div class="widget-stats-icon widget-stats-icon-primary">
                            <i class="material-icons-outlined">paid</i>
                        </div>
                        <div class="widget-stats-content flex-fill">
                            <span class="widget-stats-title">Total Sales</span>
                            <span class="widget-stats-amount">{{ number_format($saleTotal) }}</span>
                            <span class="widget-stats-info">{{ number_format($saleOrder) }} Sales</span>
                        </div>
                        {{-- <div class="widget-stats-indicator widget-stats-indicator-positive align-self-start">
                            <i class="material-icons">keyboard_arrow_up</i> {{ $saleOrder / 100 }}%
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card widget widget-stats">
                <div class="card-body">
                    <div class="widget-stats-container d-flex">
                        <div class="widget-stats-icon widget-stats-icon-warning">
                            <i class="material-icons-outlined">shopping_cart</i>
                        </div>
                        <div class="widget-stats-content flex-fill">
                            <span class="widget-stats-title">Total Purchases</span>
                            <span class="widget-stats-amount">{{ number_format($purchaseTotal) }}.00</span>
                            <span class="widget-stats-info">
                                <b>{{ $purchaseOrder }}</b> Purchases
                            </span>
                        </div>
                        {{-- <div class="widget-stats-indicator widget-stats-indicator-negative align-self-start">
                            <i class="material-icons">keyboard_arrow_down</i> 12%
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card widget widget-stats">
                <div class="card-body">
                    <div class="widget-stats-container d-flex">
                        <div class="widget-stats-icon widget-stats-icon-danger">
                            <i class="material-icons-outlined">warehouse</i>
                        </div>
                        <div class="widget-stats-content flex-fill">
                            <span class="widget-stats-title">Total Items (In Stock)</span>
                            <span class="widget-stats-amount">{{ number_format($inventoryTotal) }}</span>
                            <span class="widget-stats-info"><b>{{ number_format($inventoryProduct) }}</b>
                                Products</span>
                        </div>
                        {{-- <div class="widget-stats-indicator widget-stats-indicator-positive align-self-start">
                            <i class="material-icons">keyboard_arrow_up</i> 7%
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-xl-12">
            <div class="card widget widget-stats-large">
                <div class="row">
                    <div class="col-xl-8">
                        <div class="widget-stats-large-chart-container">
                            <div class="card-header">
                                <h5 class="card-title">Earnings<span class="badge badge-light badge-style-light">Last
                                        Year</span></h5>
                            </div>
                            <div class="card-body">
                                <div id="apex-earnings"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="widget-stats-large-info-container">
                            <div class="card-header">
                                <h5 class="card-title">Top Products<span class="badge badge-info badge-style-light">
                                    </span></h5>
                            </div>
                            <div class="card-body">
                                <p class="card-description"></p>
                                <ul class="list-group list-group-flush">
                                    @foreach ($itemsTops as $itemTop)
                                        <li class="list-group-item">{{ $itemTop->name }}<span
                                            class="float-end text-success">14%<i
                                            class="material-icons align-middle">keyboard_arrow_up</i></span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>  

@endsection
