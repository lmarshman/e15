<!doctype html>
<html lang='en'>

<head>
    <title>@yield('title', 'Bookmark')</title>
    <meta charset='utf-8'>
    <link href='/css/bookmark.css' type='text/css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </script>
    </body>
    @yield('head')
</head>

<body>

    @if (session('flash-alert'))
        <div class='flash-alert'>{{ session('flash-alert') }}</div>
    @endif

    <header>
        <a href='/'><img src='/images/bookmark-logo@2x.png' id='logo' alt='Bookmark Logo'></a>
        <nav>
            <ul>
                <li><a href='/'>Home</a></li>
                @if (Auth::user())
                    <li><a href='/books'>All Books</a></li>
                    <li><a href='/books/create'>Add a Book</a></li>
                    <li><a href='/list'>Your list</a></li>
                    <li><a href='/routes/RoutesForm'>Routes Form</a></li>
                @endif

                <li><a href='/contact'>Contact</a></li>

                <li>
                    @if (!Auth::user())
                        <a href='/login'>Login</a>
                    @else
                        <form method='POST' id='logout' action='/logout'>
                            {{ csrf_field() }}
                            <a href='#' onClick='document.getElementById("logout").submit();'>Logout</a>
                        </form>
                    @endif
            </ul>
        </nav>
    </header>

    <section id='main'>
        @yield('content')
    </section>

    <footer>
        &copy; Bookmark, Inc.
        {{ config('mail.contact_email') }}
    </footer>

</body>

</html>
