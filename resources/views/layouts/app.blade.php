<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Wapi Bulgaria Library</title>

    <!-- Styles -->
    <link href={{ asset('css/app.css') }} rel="stylesheet">

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'basePath' => asset('/'),
        ]); ?>
    </script>
</head>
<body style="background-image:url('{{ asset('images/background_image.jpg') }}');position:relative">
    <div id="app">
        <div class="container main-container">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="container-fluid">
                        <div class="form-group">
                            <div class="pull-left">
                                <a href="{{ asset('/') }}">
                                    <img class="img-responsive" src="{{ asset('images/brand.png') }}">
                                </a>
                            </div>

                            <div class="pull-right">
                                @if (Auth::check())
                                    <ul class="nav navbar-nav navbar-right">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                                Hello, {{ Auth::user()->name }} <span class="caret"></span>
                                            </a>

                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a href="{{ url('/logout') }}"
                                                       onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                        Logout
                                                    </a>

                                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                                        {{ csrf_field() }}
                                                    </form>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                <div class="row pull-right">
                                    <button type="button" class="btn btn-default right-buffer" onclick="window.location.href = '{{ url('/books') }}'">
                                        <span class="pull-left">All Books</span>
                                        <span class="glyphicon glyphicon-list-alt pull-right" aria-hidden="true"></span>
                                    </button>
                                </div>
                                @else
                                    <button class="btn btn-default" onclick="window.location.href = '{{ url('/login') }}'">Login</button>
                                    <button class="btn btn-default" onclick="window.location.href = '{{ asset('/register') }}'">Register</button>
                                @endif
                            </div>
                        </div>
                    </div>
                        <div class="container-fluid">
                            @yield('content')
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src={{ asset('js/app.js') }}></script>

</body>
</html>
