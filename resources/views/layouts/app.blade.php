<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="shortcut icon" href="{{{ asset('img/brand.ico') }}}">
    <link rel="apple-touch-icon" href="{{ asset('img/brand.ico') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'Administration - Smart Plumbing Solutions' }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/jSignature.min.js') }}"></script>

    <script src="{{ asset('js/script.js') }}?20190816"></script>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
</head>
<body>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ URL::to('/') }}/img/brand.ico" width="30" height="30" alt="{{ 'Administration - Smart Plumbing Solutions' }}"/>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::to('/') }}">Home</a>
                        </li>
                        @if (isset(Auth::user()->administrator) && Auth::user()->administrator)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ URL::to('/users') }}">Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ URL::to('/employees?params=true') }}">Employees</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ URL::to('/jobs') }}">Jobs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ URL::to('/parameters') }}">Parameters</a>
                            </li>
                            @if (isset(Auth::user()->tester) && Auth::user()->tester)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ URL::to('/employee_entries') }}">Employees Entries</a>
                            </li>
                            @endif

                        @endif
                        @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Modules
                            </a>
                            <div class="dropdown-menu dropright" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ URL::to('/timesheets') }}?filter=1">Time Sheets</a>
                                @if (isset(Auth::user()->tester) && Auth::user()->tester)
                                <a class="dropdown-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="padding-left: 24px;">
                                        Q.A Forms <span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{URL::to('/qa_users')}}">{{ __('Q.A') }}</a>
                                        <a class="dropdown-item" href="{{URL::to('/qa_types')}}">{{ __('Q.A Types') }}</a>
                                    </div>
                                </a>
                                @endif
                                <a class="dropdown-item" href="{{ URL::to('/employee_application') }}" style="display: none;">Employee Application</a>
                            </div>
                        </li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        @else
                        <li class="nav-item mr-5">
                          <span class="nav-link">
                            <strong>Week End:</strong>
                              {{ isset(App\Parameters::all()->first()->week_end_timesheet) ? Carbon::parse(App\Parameters::all()->first()->week_end_timesheet)->format('d/m/Y') : ''}}

                          </span>
                        </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="users/{{Auth::user()->id}}/edit">{{ __('Change Password') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @if($flash = session('success'))
        <div id="flash-message" class="alert alert-success" role="alert">
            <strong class="mr-2">{{$flash}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if($erros = session('error'))
        <div class="col-md-5 offset-md-3">
            <div id="flash-message" class="alert alert-danger align-items-center" role="alert">
                @foreach($error as $err)
                <strong class="mr-2">{{$err}}</strong>
                <br/>
                @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <div id="modalLoading" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLoading" aria-hidden="true" style="z-index: 99999;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="width: 48px">
                <span class="fa fa-spinner fa-spin fa-3x"></span>
            </div>
        </div>
    </div>
</body>
</html>
