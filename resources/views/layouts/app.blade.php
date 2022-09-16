<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!--datatabe -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    
    <!--datatable-->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />  

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>



                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                        @guest
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    {{__('Inventory')}}
                                </a>
                                <ul class="dropdown-menu">
                                    <li> <a class="dropdown-item"   href="{{route('inventory.inventoryItems.index')}}">{{__('Items')}}</a></li>
                                    <li><a class="dropdown-item"
                                            href="{{ route('inventory.inventoryCategories.index') }}">{{ __('Categories') }}</a>
                                    </li>
                
                                    <li><a class="dropdown-item"
                                        href="{{ route('inventory.inventoryWarehouses.index') }}">{{ __('Warehouses') }}</a>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    {{ __('Settings') }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item"
                                            href="{{ route('config.unitTypes.index') }}">{{ __('Unit Types') }}</a></li>
                                    <li><a class="dropdown-item" href="{{ route('config.units.index') }}"
                                            class="nav-link">{{ __('Units') }}</a></li>
                                    <li><a class="dropdown-item" href="{{ route('config.roles.index') }}"
                                                class="nav-link">{{ __('Roles') }}</a></li>
                                    <li><a class="dropdown-item" href="{{ route('config.users.index') }}"
                                                    class="nav-link">{{ __('Users') }}</a></li>

                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>
                        @endguest
                    </ul>

                    <!-- Left Side Of Navbar -->

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    
			
	
<script>
  $(document).ready(function () {
    $('#example').DataTable();
});
</script>
        
        
           
   
    <script>
         $('.phone').on('focus',function(){
                  phone_($(this));
              });
              $('.phone').on('input',function(){
                  phone_($(this));
              });
              $('.phone').on('change',function(){
                  phone_($(this));
              });
  
              function phone_(element){
                  $.mask.definitions['~'] = "[+-]";
                  element.mask("0999999999");
              }
  
              var i = 0;
              $('#receive').on('click', '.tr_clone_add', function() {
                  previous_no = parseInt(i?i:0);
                  i++;
                  next_no = i;
                  var $tr    = $(this).closest('.dubplicate_row');
                  var $clone = $tr.clone(true,true);
                  $clone.children().children('.item').addClass('item'+next_no);
                  $clone.children().children('.item').attr('data-index',next_no);
                  $clone.children().children('.quantity').addClass('quantity'+next_no);
                  $clone.children().children('.quantity').attr('data-index',next_no);
  
                  $clone.find(':text').val('');
                  $tr.after($clone);
                  for(j = (next_no -1); j >= 0; j--){
                      $('.item'+next_no).removeClass('item'+j);
                      $('.quantity'+next_no).removeClass('quantity'+j);
                  }
  
              });
  
              $('#receive').on('click', '.tr_clone_remove', function() {
                  numItems = $('.dubplicate_row').length;
                  if(numItems > 1){
                      $(this).closest('.dubplicate_row').remove();
                  }else{
                      alert("Must have single item row");
                  }
                  $("#source_account_id").change();
              });
    </script>
</body>

</html>
