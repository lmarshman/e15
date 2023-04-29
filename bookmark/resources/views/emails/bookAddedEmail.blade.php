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
    {{-- <a href='/'><img src='{{ $message->embed(images/bookmark-logo@2x.png) }}' id='logo' alt='Bookmark Logo'></a> --}}

    <h1>You've added a new book!</h1>

    <h4>Hello,</h4>

    <p>You've added a book to Bookmark.com! Here are the details of the book:</p>

    <img class='cover' src='{{ $book->cover_url }}' alt='Cover photo for {{ $book->title }}'>

    <h1 id='title'>{{ $book->title }}</h1>

    <a href='{{ $book->purchase_url }}'>Purchase...</a>

    <p class='description'>
        {{ $book->description }}
        <a href='{{ $book->info_url }}'>Learn more...</a>
    </p>

</body>
