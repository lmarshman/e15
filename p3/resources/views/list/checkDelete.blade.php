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
    <div class='deleteCheck'>
        <h2>Are you sure you want to delete {{ $location->name }} from your list?</h2>
        <h4>This will also delete your notes for this location. Do you want to proceed?</h4>
    </div>

    <div class='deletePage'>
        <form method='POST' action='/list/{{ $location->name }}/destroy'>
            {{ method_field('delete') }}
            {{ csrf_field() }}
            <button type='submit' class='btn btn-danger'>Yes, Delete {{ $location->name }} from my locations</button>
        </form>
    </div>

    <h5 class='deletePage'><a href='/list'>No, go back to My Locations</a></h5>
@endsection
