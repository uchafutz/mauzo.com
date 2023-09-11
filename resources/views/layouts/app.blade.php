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


                    @if (Auth::user()->is_admin)
                    <li class="{{ request()->is('expense*') ? 'active-page' : '' }}">
                        <a href=""><i class="material-icons-two-tone">inbox</i>Expenses<i
                                class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a class="{{ request()->is('expense/categories*') ? 'active' : '' }}"
                                    href="{{ route('expense.expenseCategories.index') }}">Expense Category</a>
                            </li>
                            <li>
                                <a class="{{ request()->is('expense/expenses*') ? 'active' : '' }}"
                                    href="{{ route('expense.expenses.index') }}">Expenses</a>
                            </li>

                        </ul>
                    </li>
                       
                    {{-- <li class="sidebar-title">
                            Inventory
                        </li>
                        <li>
                            <a href="mailbox.html"><i class="material-icons-two-tone">inbox</i>Categories</a>
                        </li>
                        <li>
                            <a href="mailbox.html"><i class="material-icons-two-tone">inbox</i>Items</a>
                        </li>

                        <li class="sidebar-title">
                            Manage Users
                        </li>
                        <li>
                            <a href="mailbox.html"><i class="material-icons-two-tone">inbox</i>Users</a>
                        </li>
                        <li>
                            <a href="mailbox.html"><i class="material-icons-two-tone">inbox</i>Roles</a>
                        </li>

                        <li class="sidebar-title">
                            Configuration
                        </li>
                        <li>
                            <a href="mailbox.html"><i class="material-icons-two-tone">inbox</i>Unit Types</a>
                        </li>
                        <li>
                            <a href="mailbox.html"><i class="material-icons-two-tone">inbox</i>Units</a>
                        </li> --}}
                    {{-- <li class="sidebar-title">
                            UI Elements
                        </li> --}}
                    {{-- <li>
                            <a href="#"><i class="material-icons-two-tone">color_lens</i>Styles<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="styles-typography.html">Typography</a>
                                </li>
                                <li>
                                    <a href="styles-code.html">Code</a>
                                </li>
                                <li>
                                    <a href="styles-icons.html">Icons</a>
                                </li>
                            </ul>
                        </li>--}}
                        <li>
                            <a href="#"><i class="material-icons-two-tone">grid_on</i>Reports<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                            <ul class="sub-menu">
                                <li>
                                    <a class="{{ request()->is('report/purchases*') ? 'active' : '' }}" href="{{route("report.purchases.report")}}">Purchase Report</a>
                                </li>
                                <li>
                                    <a class="{{ request()->is('report/sales*') ? 'active' : '' }}"  href="{{route("report.sales.report")}}">Sales Report</a>
                                </li>
                            </ul>
                        </li> 
                    <li class="{{ request()->is('config*') ? 'active-page' : '' }}">
                            <a href=""><i class="material-icons-two-tone">settings</i>Settings<i
                                    class="material-icons has-sub-menu">keyboard_arrow_right</i></a>

                            <ul class="sub-menu">
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
                                                             <li>
                                <a class="{{ request()->is('config/vendors*') ? 'active' : '' }}"
                                    href="{{ route('config.vendors.index') }}">Vendor</a>
                            </li>
                            </ul>
                        </li>
                    @endif
                </ul>
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
                                            <li><a class="dropdown-item" href="{{ route('stock.stockTransfers.create')}}">New Stock Transfer</a></li>
                                            <li><a class="dropdown-item" href="{{ route('sale.sales.create')}}">New Sale</a></li>
                                            <li><a class="dropdown-item" href="{{ route('inventory.inventoryItems.index')}}">Inventory List</a></li>
                                        </ul>
                                    </li>
                                </ul>

                            </div>
                            <div class="d-flex">
                                <ul class="navbar-nav">
                                   
                                    <li class="nav-item hidden-on-mobile">
                                        {{-- <a class="nav-link nav-notifications-toggle" id="notificationsDropDown"
                                            href="#" data-bs-toggle="dropdown">4</a> --}}
                                        <div class="dropdown-menu dropdown-menu-end notifications-dropdown"
                                            aria-labelledby="notificationsDropDown">
                                            <h6 class="dropdown-header">Notifications</h6>
                                            {{-- <div class="notifications-dropdown-list">
                                                <a href="#">
                                                    <div class="notifications-dropdown-item">
                                                        <div class="notifications-dropdown-item-image">
                                                            <span class="notifications-badge bg-info text-white">
                                                                <i class="material-icons-outlined">campaign</i>
                                                            </span>
                                                        </div>
                                                        <div class="notifications-dropdown-item-text">
                                                            <p class="bold-notifications-text">Donec tempus nisi sed erat
                                                                vestibulum, eu suscipit ex laoreet</p>
                                                            <small>19:00</small>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notifications-dropdown-item">
                                                        <div class="notifications-dropdown-item-image">
                                                            <span class="notifications-badge bg-danger text-white">
                                                                <i class="material-icons-outlined">bolt</i>
                                                            </span>
                                                        </div>
                                                        <div class="notifications-dropdown-item-text">
                                                            <p class="bold-notifications-text">Quisque ligula dui,
                                                                tincidunt nec pharetra eu, fringilla quis mauris</p>
                                                            <small>18:00</small>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notifications-dropdown-item">
                                                        <div class="notifications-dropdown-item-image">
                                                            <span class="notifications-badge bg-success text-white">
                                                                <i class="material-icons-outlined">alternate_email</i>
                                                            </span>
                                                        </div>
                                                        <div class="notifications-dropdown-item-text">
                                                            <p>Nulla id libero mattis justo euismod congue in et metus</p>
                                                            <small>yesterday</small>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notifications-dropdown-item">
                                                        <div class="notifications-dropdown-item-image">
                                                            <span class="notifications-badge">
                                                                <img src="../../assets/images/avatars/avatar.png"
                                                                    alt="">
                                                            </span>
                                                        </div>
                                                        <div class="notifications-dropdown-item-text">
                                                            <p>Praesent sodales lobortis velit ac pellentesque</p>
                                                            <small>yesterday</small>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notifications-dropdown-item">
                                                        <div class="notifications-dropdown-item-image">
                                                            <span class="notifications-badge">
                                                                <img src="../../assets/images/avatars/avatar.png"
                                                                    alt="">
                                                            </span>
                                                        </div>
                                                        <div class="notifications-dropdown-item-text">
                                                            <p>Praesent lacinia ante eget tristique mattis. Nam sollicitudin
                                                                velit sit amet auctor porta</p>
                                                            <small>yesterday</small>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div> --}}
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

                                <div class="d-flex align-items-center">
                                    <h1 class="flex-grow-1">@yield('page_title')</h1>
                                    @yield('page_action')
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
