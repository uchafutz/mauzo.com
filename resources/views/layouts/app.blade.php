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
</head>

<body>
    <div class="app align-content-stretch d-flex flex-wrap">
        <div class="app-sidebar">
            <div class="logo">
                <a href="index.html" class="logo-icon"><span class="logo-text">Photon</span></a>
                <div class="sidebar-user-switcher user-activity-online">
                    <a href="#">
                        <img src="{{ asset('neptune/images/avatars/avatar.png') }}">
                        <span class="activity-indicator"></span>
                        <span class="user-info-text">
                            {{ Auth::user()->name }}
                            <br>

                            <span class="user-state-info">Admin</span>
                        </span>
                    </a>
                </div>
            </div>
            <div class="app-menu">
                <ul class="accordion-menu">
                    <li class="sidebar-title">
                        Main Menu
                    </li>
                    <li class="{{ (request()->is('home')) ? 'active-page' : '' }}">
                        <a href="{{ route('home') }}" class=""><i
                                class="material-icons-two-tone">dashboard</i>Dashboard</a>
                    </li>
                    {{-- <li>
                            <a href="mailbox.html"><i class="material-icons-two-tone">inbox</i>Mailbox<span class="badge rounded-pill badge-danger float-end">87</span></a>
                        </li>
                        <li>
                            <a href="file-manager.html"><i class="material-icons-two-tone">cloud_queue</i>File Manager</a>
                        </li>
                        <li>
                            <a href="calendar.html"><i class="material-icons-two-tone">calendar_today</i>Calendar<span class="badge rounded-pill badge-success float-end">14</span></a>
                        </li>
                        <li>
                            <a href="todo.html"><i class="material-icons-two-tone">done</i>Todo</a>
                        </li> --}}
                    <li class="{{ (request()->is('sale/sales*')) ? 'active-page' : '' }}">
                        <a href="{{ route('sale.sales.index') }}"><i class="material-icons-two-tone">attach_money</i>Sales</a>
                    </li>
                    <li  class="{{ (request()->is('purchase/purchases*')) ? 'active-page' : '' }}">
                        <a href="{{ route('purchase.purchases.index') }}"><i
                                class="material-icons-two-tone">shopping_cart</i>Purchases</a>
                    </li>
                    <li class="{{ (request()->is('inventory/manufacturings*')) ? 'active-page' : '' }}">
                        <a href="{{ route('inventory.manufacturings.index') }}"><i
                                class="material-icons-two-tone">precision_manufacturing</i>Manufacturing</a>
                    </li>
                    <li  class="{{ (request()->is('customer/customers*')) ? 'active-page' : '' }}">
                        <a href="{{ route('customer.customers.index') }}"><i
                                class="material-icons-two-tone">groups</i>Customers</a>
                    </li>
                    <li  class="{{ (request()->is('inventory*')) ? 'active-page' : '' }}">
                        <a href="">
                            <i class="material-icons-two-tone">warehouse</i>
                            Inventory
                            <i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a  class="{{ (request()->is('inventory/inventoryCategories*')) ? 'active' : '' }}" href="{{ route('inventory.inventoryCategories.index') }}">Categories</a>
                            </li>
                            <li>
                                <a class="{{ (request()->is('inventory/inventoryItems*')) ? 'active' : '' }}" href="{{ route('inventory.inventoryItems.index') }}">Items</a>
                            </li>
                            <li>
                                <a  class="{{ (request()->is('inventory/inventoryWarehouses*')) ? 'active' : '' }}" href="{{ route('inventory.inventoryWarehouses.index') }}">Warehouses</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ (request()->is('config*')) ? 'active-page' : '' }}">
                        <a href=""><i class="material-icons-two-tone">settings</i>Settings<i
                                class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a class="{{ (request()->is('config/users*')) ? 'active' : '' }}" href="{{ route('config.users.index') }}">Users</a>
                            </li>
                            <li>
                                <a class="{{ (request()->is('config/roles*')) ? 'active' : '' }}" href="{{ route('config.roles.index') }}">Roles</a>
                            </li>
                            <li>
                                <a class="{{ (request()->is('config/units*')) ? 'active' : '' }}" href="{{ route('config.units.index') }}">Units</a>
                            </li>
                            <li>
                                <a class="{{ (request()->is('config/unitTypes*')) ? 'active' : '' }}" href="{{ route('config.unitTypes.index') }}">Unit Types</a>
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
                        </li>
                        <li>
                            <a href="#"><i class="material-icons-two-tone">grid_on</i>Tables<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="tables-basic.html">Basic</a>
                                </li>
                                <li>
                                    <a href="tables-datatable.html">DataTable</a>
                                </li>
                            </ul>
                        </li> --}}
                    {{-- <li>
                            <a href=""><i class="material-icons-two-tone">sentiment_satisfied_alt</i>Elements<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="ui-alerts.html">Alerts</a>
                                </li>
                                <li>
                                    <a href="ui-avatars.html">Avatars</a>
                                </li>
                                <li>
                                    <a href="ui-badge.html">Badge</a>
                                </li>
                                <li>
                                    <a href="ui-breadcrumbs.html">Breadcrumbs</a>
                                </li>
                                <li>
                                    <a href="ui-buttons.html">Buttons</a>
                                </li>
                                <li>
                                    <a href="ui-button-groups.html">Button Groups</a>
                                </li>
                                <li>
                                    <a href="ui-collapse.html">Collapse</a>
                                </li>
                                <li>
                                    <a href="ui-dropdown.html">Dropdown</a>
                                </li>
                                <li>
                                    <a href="ui-images.html">Images</a>
                                </li>
                                <li>
                                    <a href="ui-pagination.html">Pagination</a>
                                </li>
                                <li>
                                    <a href="ui-popovers.html">Popovers</a>
                                </li>
                                <li>
                                    <a href="ui-progress.html">Progress</a>
                                </li>
                                <li>
                                    <a href="ui-spinners.html">Spinners</a>
                                </li>
                                <li>
                                    <a href="ui-toast.html">Toast</a>
                                </li>
                                <li>
                                    <a href="ui-tooltips.html">Tooltips</a>
                                </li>
                            </ul>
                        </li> --}}
                    {{-- <li>
                            <a href="#"><i class="material-icons-two-tone">card_giftcard</i>Components<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="components-accordions.html">Accordions</a>
                                </li>
                                <li>
                                    <a href="components-block-ui.html">Block UI</a>
                                </li>
                                <li>
                                    <a href="components-cards.html">Cards</a>
                                </li>
                                <li>
                                    <a href="components-carousel.html">Carousel</a>
                                </li>
                                <li>
                                    <a href="components-countdown.html">Countdown</a>
                                </li>
                                <li>
                                    <a href="components-lightbox.html">Lightbox</a>
                                </li>
                                <li>
                                    <a href="components-lists.html">Lists</a>
                                </li>
                                <li>
                                    <a href="components-modals.html">Modals</a>
                                </li>
                                <li>
                                    <a href="components-tabs.html">Tabs</a>
                                </li>
                                <li>
                                    <a href="components-session-timeout.html">Session Timeout</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="widgets.html"><i class="material-icons-two-tone">widgets</i>Widgets</a>
                        </li>
                        <li>
                            <a href="#"><i class="material-icons-two-tone">edit</i>Forms<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="forms-basic.html">Basic</a>
                                </li>
                                <li>
                                    <a href="forms-input-groups.html">Input Groups</a>
                                </li>
                                <li>
                                    <a href="forms-input-masks.html">Input Masks</a>
                                </li>
                                <li>
                                    <a href="forms-layouts.html">Form Layouts</a>
                                </li>
                                <li>
                                    <a href="forms-validation.html">Form Validation</a>
                                </li>
                                <li>
                                    <a href="forms-file-upload.html">File Upload</a>
                                </li>
                                <li>
                                    <a href="forms-text-editor.html">Text Editor</a>
                                </li>
                                <li>
                                    <a href="forms-datepickers.html">Datepickers</a>
                                </li>
                                <li>
                                    <a href="forms-select2.html">Select2</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="material-icons-two-tone">analytics</i>Charts<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="charts-apex.html">Apex</a>
                                </li>
                                <li>
                                    <a href="charts-chartjs.html">ChartJS</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-title">
                            Layout
                        </li>
                        <li>
                            <a href="#"><i class="material-icons-two-tone">view_agenda</i>Content<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="content-page-headings.html">Page Headings</a>
                                </li>
                                <li>
                                    <a href="content-section-headings.html">Section Headings</a>
                                </li>
                                <li>
                                    <a href="content-left-menu.html">Left Menu</a>
                                </li>
                                <li>
                                    <a href="content-right-menu.html">Right Menu</a>
                                </li>
                                <li>
                                    <a href="content-boxed-content.html">Boxed Content</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="material-icons-two-tone">menu</i>Menu<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="menu-off-canvas.html">Off-Canvas</a>
                                </li>
                                <li>
                                    <a href="menu-standard.html">Standard</a>
                                </li>
                                <li>
                                    <a href="menu-dark-sidebar.html">Dark Sidebar</a>
                                </li>
                                <li>
                                    <a href="menu-hover-menu.html">Hover Menu</a>
                                </li>
                                <li>
                                    <a href="menu-colored-sidebar.html">Colored Sidebar</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="material-icons-two-tone">view_day</i>Header<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="header-basic.html">Basic</a>
                                </li>
                                <li>
                                    <a href="header-full-width.html">Full-width</a>
                                </li>
                                <li>
                                    <a href="header-transparent.html">Transparent</a>
                                </li>
                                <li>
                                    <a href="header-large.html">Large</a>
                                </li>
                                <li>
                                    <a href="header-colorful.html">Colorful</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-title">
                            Other
                        </li>
                        <li>
                            <a href="#"><i class="material-icons-two-tone">bookmark</i>Documentation</a>
                        </li>
                        <li>
                            <a href="#"><i class="material-icons-two-tone">access_time</i>Change Log</a>
                        </li> --}}
                </ul>
            </div>
        </div>

        <div class="app-container">
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
                                        <li><a class="dropdown-item" href="#">Manufacture Item</a></li>
                                        <li><a class="dropdown-item" href="#">New Sale</a></li>
                                    </ul>
                                </li>
                                {{-- <li class="nav-item dropdown hidden-on-mobile">
                                        <a class="nav-link dropdown-toggle" href="#" id="exploreDropdownLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="material-icons-outlined">explore</i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-lg large-items-menu" aria-labelledby="exploreDropdownLink">
                                            <li>
                                                <h6 class="dropdown-header">Repositories</h6>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <h5 class="dropdown-item-title">
                                                        Neptune iOS
                                                        <span class="badge badge-warning">1.0.2</span>
                                                        <span class="hidden-helper-text">switch<i class="material-icons">keyboard_arrow_right</i></span>
                                                    </h5>
                                                    <span class="dropdown-item-description">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <h5 class="dropdown-item-title">
                                                        Neptune Android
                                                        <span class="badge badge-info">dev</span>
                                                        <span class="hidden-helper-text">switch<i class="material-icons">keyboard_arrow_right</i></span>
                                                    </h5>
                                                    <span class="dropdown-item-description">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span>
                                                </a>
                                            </li>
                                            <li class="dropdown-btn-item d-grid">
                                                <button class="btn btn-primary">Create new repository</button>
                                            </li>
                                        </ul>
                                    </li> --}}
                            </ul>

                        </div>
                        <div class="d-flex">
                            <ul class="navbar-nav">
                                {{-- <li class="nav-item hidden-on-mobile">
                                        <a class="nav-link active" href="#">Applications</a>
                                    </li>
                                    <li class="nav-item hidden-on-mobile">
                                        <a class="nav-link" href="#">Reports</a>
                                    </li>
                                    <li class="nav-item hidden-on-mobile">
                                        <a class="nav-link" href="#">Projects</a>
                                    </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link toggle-search" href="#"><i
                                            class="material-icons">search</i></a>
                                </li>
                                <li class="nav-item hidden-on-mobile">
                                    <a class="nav-link nav-notifications-toggle" id="notificationsDropDown"
                                        href="#" data-bs-toggle="dropdown">4</a>
                                    <div class="dropdown-menu dropdown-menu-end notifications-dropdown"
                                        aria-labelledby="notificationsDropDown">
                                        <h6 class="dropdown-header">Notifications</h6>
                                        <div class="notifications-dropdown-list">
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
                                        </div>
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
            <div class="app-content">
                <div class="content-wrapper">

                    @section('header')
                        <div class="container mb-2">
                            <div class="page-description">
                                {{-- <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                                            <li class="breadcrumb-item"><a href="#">Library</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Data</li>
                                        </ol>
                                    </nav> --}}
                                {{ Breadcrumbs::render() }}

                                <div class="d-flex align-items-center">
                                    <h1 class="flex-grow-1">@yield('page_title')</h1>
                                    @yield('page_action')
                                </div>
                                {{-- <span>@yield('page_description')</span> --}}
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
