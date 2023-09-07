@extends('layouts.app')

@section('header')
    <div class="row">
        <div class="col">
            <div class="page-description d-flex align-items-center">
                <div class="page-description-content flex-grow-1">
                    <h1>Dashboard</h1>
                </div>
                <div class="page-description-actions">
                    <a href="#" class="btn btn-info btn-style-light"><i
                            class="material-icons-outlined">file_download</i>Download</a>
                    <a href="#" class="btn btn-warning btn-style-light"><i class="material-icons">add</i>Create</a>
                </div>
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
                                <span class="widget-stats-title">Total Items</span>
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


        <div class="row">
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
        </div>
        {{-- <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <img src="../../assets/images/widgets/blog5.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">The M1 Macbook Pro is Blazing Fast</h5>
                        <p class="card-text">Pellentesque habitant morbi tristique senectus et. Curabitur molestie in
                            tellus sed porttitor. Etiam eget erat erat. Nullam auctor a justo lacinia varius.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Small chip. Giant leap.</li>
                        <li class="list-group-item">Creates beauty like a beast.</li>
                        <li class="list-group-item">Make connections. Faster than ever.</li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-stats-container d-flex">
                            <div class="widget-stats-icon widget-stats-icon-warning">
                                <i class="material-icons-outlined">task_alt</i>
                            </div>
                            <div class="widget-stats-content flex-fill">
                                <span class="widget-stats-title">Tasks Completed</span>
                                <span class="widget-stats-amount">1,871</span>
                            </div>
                            <div class="widget-stats-indicator align-self-start">
                                <i class="material-icons">keyboard_arrow_down</i> 18%
                            </div>
                        </div>
                        <div class="widget-stats-chart">
                            <div id="widget-stats-chart1"></div>
                        </div>
                    </div>
                </div>
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-stats-container d-flex">
                            <div class="widget-stats-icon widget-stats-icon-danger">
                                <i class="material-icons-outlined">star_border_purple500</i>
                            </div>
                            <div class="widget-stats-content flex-fill">
                                <span class="widget-stats-title">Engagement</span>
                                <span class="widget-stats-amount">45,661</span>
                            </div>
                            <div class="widget-stats-indicator align-self-start">
                                <i class="material-icons">keyboard_arrow_up</i> 25%
                            </div>
                        </div>
                        <div class="widget-stats-chart">
                            <div id="widget-stats-chart2"></div>
                        </div>
                    </div>
                </div>
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-stats-container d-flex">
                            <div class="widget-stats-icon widget-stats-icon-primary">
                                <i class="material-icons-outlined">account_balance_wallet</i>
                            </div>
                            <div class="widget-stats-content flex-fill">
                                <span class="widget-stats-title">Balance</span>
                                <span class="widget-stats-amount">$218,655</span>
                            </div>
                            <div class="widget-stats-indicator align-self-start">
                                <i class="material-icons">keyboard_arrow_down</i> 9%
                            </div>
                        </div>
                        <div class="widget-stats-chart">
                            <div id="widget-stats-chart3"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card widget">
                    <div class="card-header">
                        <h5 class="card-title">Share this Link</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted d-block">This link will be opened in a new window</p>
                        <div class="input-group">
                            <input type="text" class="form-control form-control-solid-bordered"
                                value="https://themeforest.net/user/stacks/portfolio"
                                aria-label="https://themeforest.net/user/stacks/portfolio" aria-describedby="share-link1">
                            <button class="btn btn-primary" type="button" id="share-link1"><i
                                    class="material-icons no-m fs-5">content_copy</i></button>
                        </div>
                    </div>
                </div>
                <div class="card widget widget-info">
                    <div class="card-body">
                        <div class="widget-info-container">
                            <div class="widget-info-image"
                                style="background: url('../../assets/images/widgets/security.svg')"></div>
                            <h5 class="widget-info-title">Advanced Security</h5>
                            <p class="widget-info-text m-t-n-xs">Nunc cursus tempor sapien, et mattis libero dapibus ut. Ut
                                a ante sit amet arcu imperdiet accumsan.</p>
                            <a href="#" class="btn btn-primary widget-info-action">Upgrade Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8">
                <div class="card widget widget-popular-blog">
                    <div class="card-body">
                        <div class="widget-popular-blog-container">
                            <div class="widget-popular-blog-image">
                                <img src="../../assets/images/widgets/product2.jpeg" alt="">
                            </div>
                            <div class="widget-popular-blog-content ps-4">
                                <span class="widget-popular-blog-title">
                                    Quisque congue risus sit amet pellentesque fermentum
                                </span>
                                <span class="widget-popular-blog-text">
                                    Morbi blandit, mi at lacinia ornare, turpis justo viverra risus, at tristique tortor
                                    massa ut arcu. Suspendisse potenti. Suspendisse cursus aliquam dictum. Curabitur nec
                                    fringilla orci. Vivamus ut viverra elit. Pellentesque id interdum odio. Fusce finibus
                                    maximus egestas.
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span class="widget-popular-blog-date">
                            Date: 6:38 PM
                        </span>
                        <a href="#" class="btn btn-primary float-end">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card widget widget-connection-request">
                    <div class="card-header">
                        <h5 class="card-title">Connection Request<span class="badge badge-secondary badge-style-light">17
                                min ago</span></h5>
                    </div>
                    <div class="card-body">
                        <div class="widget-connection-request-container d-flex">
                            <div class="widget-connection-request-avatar">
                                <div class="avatar avatar-xl m-r-xs">
                                    <img src="../../assets/images/avatars/avatar.png" alt="">
                                </div>
                            </div>
                            <div class="widget-connection-request-info flex-grow-1">
                                <span class="widget-connection-request-info-name">
                                    Woodrow Hawkins
                                </span>
                                <span class="widget-connection-request-info-count">
                                    45 mutual connections
                                </span>
                                <span class="widget-connection-request-info-about">
                                    Senior Go Developer at Google
                                </span>
                            </div>
                        </div>
                        <div class="widget-connection-request-actions d-flex">
                            <a href="#" class="btn btn-primary btn-style-light flex-grow-1 m-r-xxs"><i
                                    class="material-icons">done</i>Accept</a>
                            <a href="#" class="btn btn-danger btn-style-light flex-grow-1 m-l-xxs"><i
                                    class="material-icons">close</i>Ignore</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
