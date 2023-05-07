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
    <div>
        @if (session('flash-alert'))
            <div class='flash-alert'>
                {{ session('flash-alert') }}
            </div>
        @endif
    </div>
    <div class="navbar navbar-light navbar-collapse" style="background-color: #e3f2fd;" data-bs-theme="dark">
        <div class="container-fluid">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                @if (Auth::user())
                    <li class="nav-item">
                        <a class="nav-link" href="/pages/list">My Locations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/pages/discover/cities">Discover</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/pages/addLocation/new">Add a new Location</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/routes/address/convert">Make a Route</a>
                    </li>
                @endif
                @if (!Auth::user())
                    <li class="nav-item">
                        <a class="nav-link" href='/login'>Login</a>
                    </li>
                @else
                    <li class="nav-item">
                        <form method='POST' id='logout' action='/logout'>
                            {{ csrf_field() }}
                            <a class="nav-link" href='#'
                                onClick='document.getElementById("logout").submit();'>Logout</a>
                        </form>
                    </li>
                @endif
            </ul>
        </div>
    </div>

    <section id='main'>
        @yield('content')
    </section>

</body>

</html>
