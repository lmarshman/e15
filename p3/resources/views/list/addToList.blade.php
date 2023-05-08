<!DOCTYPE html>
@extends('layouts/main')

@section('head')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href='/css/cityRoutes.css' rel='stylesheet'>
@endsection

@section('title')
    CityRoutes
@endsection

@section('content')
    <h3 class='addressHeader'>Add {{ $location->name }} to your list?</h3>

    <div class='addressForm'>
        <form method='POST' action='/list/{{ $location->name }}/save'>

            {{ csrf_field() }}
            <div class="mb-3">
                <label class="form-label" for='notes'>Would you like to add any notes for this location?</label>
                <textarea class="form-control" name='notes' test='notes-textarea'>{{ old('notes') }}</textarea>
            </div>
            <button type='submit' test='add-to-list-button' class='btn btn-primary'>Add to your list</button>
        </form>

        @if (count($errors) > 0)
            <ul class='alert alert-danger'>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

    </div>
@endsection
