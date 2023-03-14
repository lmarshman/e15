<!doctype html>
<html lang='en'>

<head>
    <title>@yield('title', 'Bookmark')</title>
    <meta charset='utf-8'>
    <link href='/css/bookmark.css' type='text/css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    </body>
    @yield('head')
</head>

<body>

    <header>
        <a href='/'><img src='/images/bookmark-logo@2x.png' id='logo' alt='Bookmark Logo'></a>
        <nav>
            <ul>
                <li><a href='/'>Home</a></li>
                <li><a href='/books'>All Books</a></li>
                <li><a href='/list'>Your list</a></li>
                <li><a href='/contact'>Contact</a></li>
            </ul>
        </nav>
    </header>

    <section>
        @yield('content')
    </section>

    <footer>
        &copy; Bookmark, Inc.
    </footer>

</body>

</html>
