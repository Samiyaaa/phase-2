<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    
  <!-- Custom fonts for this template-->
  <link href="/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="/admin/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('admin/css/sb-admin.css')}}" rel="stylesheet">

  <link href="{{ asset('select2/dist/css/select2.min.css') }}" rel="stylesheet" />

  {{-- <link href="{{asset ('select2/dist/css/select2.min.css')}}" rel="stylesheet" /> --}}

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">

            <a class="navbar-brand mr-1" href="#">{{config('app.name')}}</a>
          
            {{-- <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
              <i class="fas fa-bars"></i>
            </button> --}}
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
                        <ul class="navbar-nav ml-auto ml-md-0">
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-user-circle fa-fw"></i>{{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                  <a class="dropdown-item" href="#">Settings</a>
                                  <a class="dropdown-item" href="#">Activity Log</a>
                                  <div class="dropdown-divider"></div>
                                  {{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"> --}}
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                {{-- </div> --}}
                                </div>
                              </li>
                        </ul>
                            
                        @endguest
                    </ul>
           </nav>    
           
        {{-- <main class="py-4"> --}}
            @yield('content')
        {{-- </main> --}}
    </div>
    {{-- ck_editor --}}
    <script src="/ckeditor/ckeditor.js" ></script>
    {{-- <script src="{{ asset('ckeditor/ckeditor.js') }}"></script> --}}
<script>
    CKEDITOR.replace('my-editor');
    </script>

{{-- select2 --}}
{{-- <script src="{{asset('js/jquery3.6.js')}}"></script> --}}
{{-- <script src="{{asset('select2/dist/js/select2.min.js')}}"></script> --}}

    
  <script src="/admin/vendor/jquery/jquery.min.js"></script>
  <script src="/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="/admin/vendor/chart.js/Chart.min.js"></script>
  <script src="/admin/vendor/datatables/jquery.dataTables.js"></script>
  <script src="/admin/vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="/admin/js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="/admin/js/demo/datatables-demo.js"></script>
  <script src="/admin/js/demo/chart-area-demo.js"></script>

  <script src="{{ asset('select2/dist/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
</body>
</html>
