
<!DOCTYPE html>
<html lang="en">
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="{{ asset('neptune/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('neptune/perfectscroll/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('neptune/plugins/pace/pace.css') }}" rel="stylesheet">

    
    <!-- Theme Styles -->
    <link href="{{ asset('neptune/css/main.min.css') }}" rel="stylesheet">
    <link href="{{ asset('neptune/css/custom.css') }}" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('photon/icon.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('photon/icon.png') }}" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .full-height {
            height: 100%;
        }
        .carousel-item img {
            width: 100%;
            height: auto;
            max-height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container-fluid full-height d-flex align-items-center justify-content-center">
        <div class="row w-100 h-100 d-flex align-items-stretch">
            <div class="col-md-8">
                <div id="carouselExampleControls" class="carousel slide h-100" data-bs-ride="carousel">
                    <div class="carousel-inner h-100">
                        <div class="carousel-item active h-100">
                            <img src="{{ asset('neptune/images/login/1.jpeg') }}" class="d-block w-100 h-100" alt="...">
                        </div>
                        <div class="carousel-item h-100">
                            <img src="{{ asset('neptune/images/login/2.jpeg') }}" class="d-block w-100 h-100" alt="...">
                        </div>
                        <div class="carousel-item h-100">
                            <img src="{{ asset('neptune/images/login/3.jpeg') }}" class="d-block w-100 h-100" alt="...">
                        </div>
                        <div class="carousel-item h-100">
                            <img src="{{ asset('neptune/images/login/4.jpeg') }}" class="d-block w-100 h-100" alt="...">
                        </div>
                        <div class="carousel-item h-100">
                            <img src="{{ asset('neptune/images/login/5.jpeg') }}" class="d-block w-100 h-100" alt="...">
                        </div>
                        <div class="carousel-item h-100">
                            <img src="{{ asset('neptune/images/login/6.jpeg') }}" class="d-block w-100 h-100" alt="...">
                        </div>
                        <div class="carousel-item h-100">
                            <img src="{{ asset('neptune/images/login/7.jpeg') }}" class="d-block w-100 h-100" alt="...">
                        </div>
                        <div class="carousel-item h-100">
                            <img src="{{ asset('neptune/images/login/8.jpeg') }}" class="d-block w-100 h-100" alt="...">
                        </div>
                        <div class="carousel-item h-100">
                            <img src="{{ asset('neptune/images/login/9.jpeg') }}" class="d-block w-100 h-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-4 bg-white d-flex align-items-center">
                <div class="p-4 w-100">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <center>
                            <img src="{{ asset('neptune/images/logo.jpeg') }}" alt="" srcset="" width="200" height="100">
                        </center>
                        <div class="mb-4 mt-4">
                            <h4 class="text-center">LOGIN</h4>
                        </div>
                        <div class="auth-credentials mb-4">
                            <div class="form-group mb-3">
                                <label for="signInEmail" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="signInEmail" placeholder="user@photon.co.tz" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="signInPassword" class="form-label">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                        <div class="auth-submit">
                            <button type="submit" class="btn btn-primary w-100">Sign In</button>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="auth-forgot-password float-end mt-3">{{ __('Forgot Your Password?') }}</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
     <!-- Javascripts -->
     <script src="{{ asset('neptune/plugins/jquery/jquery-3.5.1.min.js') }}"></script>
     <script src="{{ asset('neptune/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
     <script src="{{ asset('neptune/plugins/perfectscroll/perfect-scrollbar.min.js') }}"></script>
     <script src="{{ asset('neptune/plugins/pace/pace.min.js') }}"></script>
     <script src="{{ asset('neptune/js/main.min.js') }}"></script>
     <script src="{{ asset('neptune/js/custom.js') }}"></script>
</body>
</html>