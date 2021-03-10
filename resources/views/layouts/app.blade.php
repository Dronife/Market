<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Market</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('plugin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('plugin/css/sb-admin-2.min.css')}}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav pl-5 ">

                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/item/create')}}">Add Items</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/item/list/')}}">Your items</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/item/top3')}}">Top 3 items</a>
                        </li>

                    </ul>

                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
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
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
        @if($notifications != null)
        <div class="row justify-content-center">
            @forelse($notifications as $notification)
            <div class="alert alert-success alert-dismissible fade show col-md-5 " role="alert">
            Cheapest item is <strong>{{$notification->data['name']}}</strong>, which costs <strong>{{$notification->data['price']}}</strong>
                <button data-id="{{$notification->id}}" type="button" class="close mark-as-read" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @empty
            @endforelse
        </div>
        @endif


        <main class="py-4">
            @yield('content')
        </main>
    </div>


    <script src="{{asset('plugin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('plugin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('plugin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('plugin/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('plugin/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('plugin/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('plugin/js/demo/chart-pie-demo.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {


            function sendMarkRequest(id = null) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax("{{url('/item/markAsRead/{id}')}}",{
                    // url: '/item/markAsRead/' + id,
                    method: 'POST',
                    data: {
                         id
                    }
                });
            }


            $(function() {
                $('.mark-as-read').click(function() {
                    // alert();
                    var id = $(this).data('id');
                    sendMarkRequest(id);
                })
            });

        });
    </script>


</body>

</html>