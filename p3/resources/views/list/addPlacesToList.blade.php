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
    <div class='addressHeader'>
        <h2>Add {{ $name }} to your list</h2>
        <p>It looks like some information is missing for this location. Please fill in the information below to add it to
            your
            list.</p>
    </div>

    <div class='addressForm'>
        <form method='POST' action='/list/{{ $name }}/place/new/cities/change'>

            {{ csrf_field() }}

            <div class="mb-3">
                <label class="form-label" for='name'>Location Name</label>
                <input type='text' class="form-control" name='name' id='name' test='place-name'
                    value='{{ $name }}'>
            </div>
            @include('includes/error-field', ['fieldName' => 'name'])

            <div class="mb-3">
                <label class="form-label" for='address'>Building number and street name</label>
                <input type='text' class="form-control" name='address' id='address' test='add-address'
                    value='{{ $addressCombined }}'>
            </div>
            @include('includes/error-field', ['fieldName' => 'address'])

            <div class="mb-3">
                <label class="form-label" for='city'>City</label>
                <input type='text' class="form-control" name='city' id='city' test='add-city'
                    value='{{ $city }}'>
            </div>
            @include('includes/error-field', ['fieldName' => 'city'])

            <div class="mb-3">
                <label class="form-label" for='state'>State Abbreviation (XX)</label>
                <input type='text' class="form-control" name='state' id='state' test='add-state'
                    value='{{ $state }}'>
            </div>
            @include('includes/error-field', ['fieldName' => 'state'])

            <div class="mb-3">
                <label class="form-label" for='country'>Country</label>
                <input type='text' class="form-control" name='country' id='country' test='add-country'
                    value='{{ $country }}'>
            </div>
            @include('includes/error-field', ['fieldName' => 'country'])

            <div class="mb-3">
                <label class="form-label" for='picture_url'>Location Picture URL</label>
                <input type='text' class="form-control" name='picture_url' id='picture_url' test='add-picture_url'
                    value='{{ old('picture_url') }}'>
            </div>
            @include('includes/error-field', ['fieldName' => 'picture_url'])

            <div class="mb-3">
                <label class="form-label" for='loc_url'>Location Website </label>
                <input type='text' class="form-control" name='loc_url' id='loc_url' test='add-loc_url'
                    value='{{ old('loc_url') }}'>
            </div>
            @include('includes/error-field', ['fieldName' => 'loc_url'])

            <div class="mb-3">
                <label class="form-label" for='description'>Description</label>
                <textarea class="form-control" name='description' test='add-description'>{{ old('description') }}</textarea>
            </div>
            @include('includes/error-field', ['fieldName' => 'description'])

            <input type='hidden' class="form-control" name='lat' id='lat' test='lat-input'
                value='{{ $lat }}'>

            <input type='hidden' class="form-control" name='long' id='long' test='long-input'
                value='{{ $long }}'>

            <button type='submit' class='btn btn-primary' test='add-button'>Add Location</button>

        </form>
    </div>
@endsection
