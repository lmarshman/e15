{{-- /resources/views/books/create.blade.php --}}
@extends('layouts/main')

@section('title')
    Add a book
@endsection

@section('head')
    <link href='/css/bookmark.css' rel='stylesheet'>
@endsection

@section('content')

    <h1>Add a book</h1>

    <p>Want to add a book to your list that isn’t in our library? Not a problem- you can add it here!</p>

    <form method='POST' action='/books'>
        <div class='details'>* Required fields</div>

        {{ csrf_field() }}

        <label for='slug'>* Short URL</label>
        <input type='text' name='slug' id='slug' value='{{ old('slug') }}'>

        <label for='title'>* Title</label>
        <input type='text' name='title' id='title' value='{{ old('title') }}'>

        <label for='author_id'>* Author</label>
        <select name='author_id'>
            <option value=''>Choose one...</option>
            @foreach ($authors as $author)
                <option value='{{ $author->id }}' {{ old('author_id') == $author->id ? 'selected' : '' }}>
                    {{ $author->first_name . ' ' . $author->last_name }}</option>
            @endforeach
        </select>
        <p><a href='/books/addAuthor'>Don't see the author? Add them here!</a></p>
        @include('includes.error-field', ['fieldName' => 'author_id'])


        <label for='published_year'>* Published Year (YYYY)</label>
        <input type='text' name='published_year' id='published_year' value='{{ old('published_year') }}'>

        <label for='cover_url'>Cover URL</label>
        <input type='text' name='cover_url' id='cover_url' value='{{ old('cover_url', 'http://') }}'>

        <label for='info_url'>* Wikipedia URL</label>
        <input type='text' name='info_url' id='info_url' value='{{ old('info_url', 'http://') }}'>

        <label for='purchase_url'>* Purchase URL </label>
        <input type='text' name='purchase_url' id='purchase_url' value='{{ old('purchase_url', 'http://') }}'>

        <label for='description'>Description</label>
        <textarea name='description'>{{ old('description') }}</textarea>

        <button type='submit' class='btn btn-primary'>Add Book</button>

        @if (count($errors) > 0)
            <ul class='alert alert-danger'>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

    </form>
@endsection
