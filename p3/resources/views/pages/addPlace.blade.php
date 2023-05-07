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
    <h3 class='addressHeader'>Add a new location</h3>

    <div class='addressForm'>
        <form method='POST' action='/pages/addLocation'>

            {{ csrf_field() }}

            <div class="mb-3">
                <label class="form-label" for='name'>Location Name</label>
                <input type='text' class="form-control" name='name' id='slug' value='{{ old('name') }}'>
            </div>
            <div class="mb-3">
                <label class="form-label" for='address'>Building number and street name</label>
                <input type='text' class="form-control" name='address' id='address' value='{{ old('address') }}'>
            </div>
            <div class="mb-3">
                <label class="form-label" for='city'>City</label>
                <input type='text' class="form-control" name='city' id='city' value='{{ old('city') }}'>
            </div>
            <div class="mb-3">
                <label class="form-label" for='state'>State Abbreviation (XX)</label>
                <input type='text' class="form-control" name='state' id='state' value='{{ old('state') }}'>
            </div>
            <div class="mb-3">
                <label class="form-label" for='country'>Country</label>
                <input type='text' class="form-control" name='country' id='country' value='{{ old('country') }}'>
            </div>
            <div class="mb-3">
                <label class="form-label" for='picture_url'>Location Picture URL</label>
                <input type='text' class="form-control" name='picture_url' id='picture_url'
                    value='{{ old('picture_url') }}'>
            </div>
            <div class="mb-3">
                <label class="form-label" for='loc_url'>Location Website </label>
                <input type='text' class="form-control" name='loc_url' id='loc_url' value='{{ old('loc_url') }}'>
            </div>
            <div class="mb-3">
                <label class="form-label" for='description'>Description</label>
                <textarea class="form-control" name='description'>{{ old('description') }}</textarea>
            </div>
            <button type='submit' test='create-book-link' class='btn btn-primary'>Add Location</button>

            @if (count($errors) > 0)
                <ul class='alert alert-danger'>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

        </form>
    </div>
@endsection
