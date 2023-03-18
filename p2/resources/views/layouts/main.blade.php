<!doctype html>
<html lang='en'>

<head>
    <title>@yield('title', 'Quick Conversions')</title>
    <meta charset='utf-8'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    @yield('head')
</head>

<body>

    <div class="navbar bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Quick Conversions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/recipe">Quick Convert: Recipes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Quick Convert: Temperature</a>
                </li>
            </ul>
        </div>
    </div>

    <section>
        @yield('content')
    </section>
</body>

</html>
