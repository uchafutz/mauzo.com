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
        <div class="app-container">
                 @yield('content')
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
