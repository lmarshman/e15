@extends('layouts/main')

@section('head')
    <link href='/css/bookmark.css' rel='stylesheet'>
@endsection

@section('title')
    Add a New Author
@endsection

@section('content')
    <h2>Add a new author</h2>
    <form method='POST' action='/newAuthor'>
        <div class='details'>* Required fields</div>

        {{ csrf_field() }}

        <label for='first_name'>Author First Name</label>
        <input type='text' name='first_name' id='first_name' value='{{ old('first_name') }}'>

        <label for='last_name'>Author Last Name</label>
        <input type='text' name='last_name' id='last_name' value='{{ old('last_name') }}'>

        <label for='birth_year'>Author Birth Year</label>
        <input type='text' name='birth_year' id='birth_year' value='{{ old('birth_year') }}'>

        <label for='bio_url'>Author Bio Link</label>
        <input type='text' name='bio_url' id='bio_url' value='{{ old('bio_url', 'http://') }}'>

    </form>
@endsection
