@extends('layouts/main')

@section('head')
    <link href='/css/bookmark.css' rel='stylesheet'>
@endsection

@section('title')
    Delete this {{ $book->title }}
@endsection

@section('content')
    <h1>Delete</h1>
    <h2>{{ $book->title }}</h2>

    <h4>Are you sure you want to delete {{ $book->title }}?</h4>

    <form method='POST' action='/books/{{ $book->slug }}'>
        {{ method_field('delete') }}
        {{ csrf_field() }}
        <button type='submit' class='btn btn-danger'>Delete {{ $book->title }}</button>
    </form>

    <p><a href='/books/{{ $book->slug }}'>No, I changed my mind.</a></p>
@endsection
