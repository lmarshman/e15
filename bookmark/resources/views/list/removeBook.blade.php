@extends('layouts/main')

@section('head')
    <link href='/css/list/show.css' rel='stylesheet'>
@endsection

@section('title')
    Delete {{ $book->title }}
@endsection

@section('content')
    <h1>Delete</h1>
    <h2>{{ $book->title }}</h2>

    <h4>Are you sure you want to delete {{ $book->title }} from your list?</h4>

    <form method='POST' action='/list/{{ $book->slug }}'>
        {{ method_field('delete') }}
        {{ csrf_field() }}
        <button type='submit' class='btn btn-danger'>Delete {{ $book->title }}</button>
    </form>

    <p><a href='/list'>No, I changed my mind.</a></p>
@endsection
