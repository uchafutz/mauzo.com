<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Photon - A Powerful ERP Software for Small and Medium Enterprises">
    <meta name="keywords" content="photon,erp,enterprice,inventory,sales,crm,hr,finance,accounts,saas,subscription">
    <meta name="author" content="stacks">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>{{ config('app.name', 'Photon') }} - ERP Software for Small and Medium Enterprises</title>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.10.3/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>



    <!--data table-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <!--data table-->

    <link href="{{ asset('neptune/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('neptune/plugins/perfectscroll/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('neptune/plugins/pace/pace.css') }}" rel="stylesheet">
    <link href=".{{ asset('neptune/plugins/highlight/styles/github-gist.css') }}" rel="stylesheet">


    <!-- Theme Styles -->


    <!-- Theme Styles -->
    <link href="{{ asset('neptune/css/main.min.css') }}" rel="stylesheet">
    <link href="{{ asset('neptune/css/custom.css') }}" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('photon/icon.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('photon/icon.png') }}" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


</head>

<body>
    <div class="app align-content-stretch d-flex flex-wrap">
        <div class="app-sidebar">
            <div class="logo">
                <div class="sidebar-user-switcher user-activity-online">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('neptune/images/avatars/avatar.png') }}">
                        <span class="activity-indicator"></span>
                        <span class="user-info-text">
                            {{ Auth::user()->name }}
                            <br>

                            <span class="user-state-info">
                                {{ Auth::user()->is_admin ? 'Admin' : 'Salesman' }}
                            </span>
                        </span>
                    </a>
                </div>
            </div>
            <div class="app-menu">
                <ul class="accordion-menu">
                    <li class="sidebar-title">
                        Main Menu
                    </li>
                    <li class="{{ request()->is('home') ? 'active-page' : '' }}">
                        <a href="{{ route('home') }}" class=""><i
                                class="material-icons-two-tone">dashboard</i>Dashboard</a>
                    </li>
                    <li class="{{ request()->is('sale/sales*') ? 'active-page' : '' }}">
                        <a href="{{ route('sale.sales.index') }}"><i
                                class="material-icons-two-tone">attach_money</i>Sales</a>
                    </li>

                    <li class="{{ request()->is('purchase/purchases*') ? 'active-page' : '' }}">
                        <a href="{{ route('purchase.purchases.index') }}"><i
                                class="material-icons-two-tone">shopping_cart</i>Purchases</a>
                    </li>
                    @if (Auth::user()->is_admin)
                        <li class="{{ request()->is('customer/customers*') ? 'active-page' : '' }}">
                            <a href="{{ route('customer.customers.index') }}"><i
                                    class="material-icons-two-tone">groups</i>Customers</a>
                        </li>
                        <li class="{{ request()->is('vendor/vendors*') ? 'active-page' : '' }}">
                            <a href="{{ route('vendor.vendors.index') }}"><i
                                    class="material-icons-two-tone">groups</i>Vendors</a>
                        </li>
                    @endif

                    <li class="{{ request()->is('inventory*') ? 'active-page' : '' }}">
                        <a href="">
                            <i class="material-icons-two-tone">warehouse</i>
                            Inventory
                            <i class="material-icons has-sub-menu">keyboard_arrow_right</i>
                        </a>
                        <ul class="sub-menu">
                            @if (Auth::user()->is_admin)
                                <li>
                                    <a class="{{ request()->is('inventory/inventoryWarehouses*') ? 'active' : '' }}"
                                        href="{{ route('inventory.inventoryWarehouses.index') }}">Warehouses</a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('inventory/inventoryCategories*') ? 'active' : '' }}"
                                        href="{{ route('inventory.inventoryCategories.index') }}">Categories</a>
                                </li>
                            @endif
                            <li>
                                <a class="{{ request()->is('inventory/inventoryItems*') ? 'active' : '' }}"
                                    href="{{ route('inventory.inventoryItems.index') }}">Items</a>
                            </li>
                        </ul>
                    </li>

                    <li class="{{ request()->is('stock*') ? 'active-page' : '' }}">
                        <a href=""><i class="material-icons-two-tone">inventory</i>Stock<i
                                class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a class="{{ request()->is('stock/stockTransfers*') ? 'active' : '' }}"
                                    href="{{ route('stock.stockTransfers.index') }}">Stock Transfer</a>
                            </li>
                              

                        </ul>
                    </li>

                    <li class="{{ request()->is('expense*') ? 'active-page' : '' }}">
                        <a href=""><i class="material-icons-two-tone">inbox</i>Expenses<i
                                class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                        <ul class="sub-menu">
                            @if (Auth::user()->is_admin)
                            <li>
                                <a class="{{ request()->is('expense/categories*') ? 'active' : '' }}"
                                    href="{{ route('expense.expenseCategories.index') }}">Expense Category</a>
                            </li>   
                            @endif
                            <li>
                                <a class="{{ request()->is('expense/expenses*') ? 'active' : '' }}"
                                    href="{{ route('expense.expenses.index') }}">Expenses</a>
                            </li>

                        </ul>
                    </li>


                    @if (Auth::user()->is_admin)
                    <li class="{{ request()->is('accounts*') ? 'active-page' : '' }}">
                        <a href=""><i class="material-icons-two-tone">account_balance</i>Account<i
                                class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a class="{{ request()->is('account/accounts*') ? 'active' : '' }}"
                                    href="{{ route('account.accounts.index') }}">Accounts</a>
                            </li>
                            <li>
                                <a class="{{ request()->is('account/accountLedgers*') ? 'active' : '' }}"
                                    href="{{ route('account.accountLedgers.index') }}">Ledgers</a>
                            </li>
                              

                        </ul>
                    </li>

                        <li>
                            <a href="#"><i class="material-icons-two-tone">grid_on</i>Reports<i
                                    class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                            <ul class="sub-menu">
                                <li>
                                    <a class="{{ request()->is('report/purchases*') ? 'active' : '' }}"
                                        href="{{ route('report.purchases.report') }}">Purchase Report</a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('report/sales*') ? 'active' : '' }}"
                                        href="{{ route('report.sales.report') }}">Sales Report</a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('report/shops*') ? 'active' : '' }}"
                                        href="{{ route('report.shops.report') }}">Shop Report</a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('report/customers*') ? 'active' : '' }}"
                                        href="{{ route('report.customers.report') }}">Customer Report</a>
                                </li>
                            </ul>
                        </li>
                        <li class="{{ request()->is('config*') ? 'active-page' : '' }}">
                            <a href=""><i class="material-icons-two-tone">settings</i>Settings<i
                                    class="material-icons has-sub-menu">keyboard_arrow_right</i></a>

                            <ul class="sub-menu">
                                <li>
                                    <a class="{{ request()->is('config/organizations*') ? 'active' : '' }}"
                                        href="{{ route('config.organizations.index') }}">Organizations</a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('config/users*') ? 'active' : '' }}"
                                        href="{{ route('config.users.index') }}">Users</a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('config/units*') ? 'active' : '' }}"
                                        href="{{ route('config.units.index') }}">Units</a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('config/unitTypes*') ? 'active' : '' }}"
                                        href="{{ route('config.unitTypes.index') }}">Unit Types</a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('config/vats*') ? 'active' : '' }}"
                                        href="{{ route('config.vats.index') }}">Vat</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
                <div class="mt-3 ml-3">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-primary">Logout</button>
                    </form> 
                </div> 
            </div>
        </div>

        <div class="app-container">
            @guest
            @else
                <div class="search">
                    <form>
                        <input class="form-control" type="text" placeholder="Type here..." aria-label="Search">
                    </form>
                    <a href="#" class="toggle-search"><i class="material-icons">close</i></a>
                </div>
                <div class="app-header">
                    <nav class="navbar navbar-light navbar-expand-lg">
                        <div class="container-fluid">
                            <div class="navbar-nav" id="navbarNav">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link hide-sidebar-toggle-button" href="#"><i
                                                class="material-icons">first_page</i></a>
                                    </li>
                                    <li class="nav-item dropdown hidden-on-mobile">
                                        <a class="nav-link dropdown-toggle" href="#" id="addDropdownLink"
                                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="material-icons">add</i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="addDropdownLink">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('purchase.purchases.create') }}">New Purchase</a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('stock.stockTransfers.create') }}">New Stock
                                                    Transfer</a></li>
                                            <li><a class="dropdown-item" href="{{ route('sale.sales.create') }}">New
                                                    Sale</a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('inventory.inventoryItems.index') }}">Inventory
                                                    List</a></li>
                                        </ul>
                                    </li>
                                </ul>

                            </div>
                            <div class="d-flex">
                                <ul class="navbar-nav">

                                    <li class="nav-item hidden-on-mobile">
                                        <div class="dropdown-menu dropdown-menu-end notifications-dropdown"
                                            aria-labelledby="notificationsDropDown">
                                            <h6 class="dropdown-header">Notifications</h6>
                                        </div>
                                    </li>
                                    <li class="nav-item hidden-on-mobile">
                                        <a class="nav-link language-dropdown-toggle" href="#" id="languageDropDown"
                                            data-bs-toggle="dropdown"><i class="material-icons">settings</i></a>
                                        <ul class="dropdown-menu dropdown-menu-end language-dropdown"
                                            aria-labelledby="languageDropDown">
                                            <li><a class="dropdown-item" href="#">Profile</a></li>
                                            <form action="{{ route('logout') }}" method="post">
                                                <li>
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">Logout</button>
                                                </li>
                                            </form>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            @endguest
            <div class="app-content">
                <div class="content-wrapper">

                    @section('header')
                        <div class="container mb-2">
                            <div class="page-description">

                                {{ Breadcrumbs::render() }}

                                <div class="row">
                                    <div class="col-md-6">
                                        <h1 class="flex-grow-1">@yield('page_title')</h1>
                                    </div>
                                    <div class="col-md-6">
                                        @yield('page_action')
                                    </div>
                                </div>
                            </div>
                        </div>
                    @show

                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Javascripts -->
    <script src="{{ asset('neptune/plugins/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('neptune/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('neptune/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('neptune/plugins/perfectscroll/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('neptune/plugins/pace/pace.min.js') }}"></script>
    <script src="{{ asset('neptune/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('neptune/js/main.min.js') }}"></script>
    <script src="{{ asset('neptune/plugins/highlight/highlight.pack.js') }}"></script>
    <script src="{{ asset('neptune/js/custom.js') }}"></script>
    <script src="{{ asset('neptune/js/pages/dashboard.js') }}"></script>
</body>

</html>
