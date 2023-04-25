@extends('layouts/main')

@section('head')
    <link href='/css/books/show.css' rel='stylesheet'>
@endsection

@section('content')
    @if (!$book)
        Book not found. <a href='/books'>Check out the other books in our library...</a>
    @else
        <img class='cover' src='{{ $book->cover_url }}' alt='Cover photo for {{ $book->title }}'>

        <h1 id='title'>{{ $book->title }}</h1>

        <a href='{{ $book->purchase_url }}'>Purchase...</a>

        <p class='description'>
            {{ $book->description }}
            <a href='{{ $book->info_url }}'>Learn more...</a>
        </p>

        <ul class='bookActions'>
            <li><a href='/list/{{ $book->slug }}/add'>Add this book to your list</a></li>
            <li><a href='/books/{{ $book->slug }}/edit'>Edit this book</a></li>
            <li><a href='/books/{{ $book->slug }}/delete'>Delete Book</a></li>
        </ul>
    @endif
@endsection
