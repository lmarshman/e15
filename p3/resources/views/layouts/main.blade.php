<!doctype html>
<html lang='en'>

<head>
    <title>@yield('title', 'CityRoutes')</title>
    <meta charset='utf-8'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href='/css/cityRoutes.css' type='text/css' rel='stylesheet'>
    @yield('head')
</head>

<body>
    @if (session('flash-alert'))
        <div class="alert alert-success">
            {{ session('flash-alert') }}
        </div>
    @endif

    <div class="navbar navbar-light navbar-collapse" style="background-color: #e3f2fd;" data-bs-theme="dark">
        <div class="container-fluid">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                @if (Auth::user())
                    <li class="nav-item">
                        <a class="nav-link" href="/list">My Locations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/pages/discover/cities">Discover</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/pages/addLocation/new">Add a new Location</a>
                    </li>
                @endif
                @if (!Auth::user())
                    <li class="nav-item">
                        <a class="nav-link" href='/login' test='login-link'>Login</a>
                    </li>
                @else
                    <form method='POST' id='logout' action='/logout'>
                        {{ csrf_field() }}

                        <button type='submit' class='btn' test='logout-button'>
                            Logout
                        </button>
                    </form>
                @endif
            </ul>
        </div>
    </div>

    <section id='main'>
        @yield('content')
    </section>

</body>

</html>
