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
    <div class='row'>
        <h2 class='discoverHeader'>Showing results for {{ $city }}</h2>
        <h4 class='discoverHeader'><a class="nav-link" href="/pages/discover/cities">Search a different city</a></h4>
    </div>
    @if ($locations == 'false')
    @else
        @foreach ($locations as $location)
            <div class='discover'>
                <div class='row'>
                    <div class='col-md-4'>
                        <img src="{{ $location->picture_url }}" alt="{{ $location->name }}" width="350" height="250">
                    </div>
                    <div class='col'>
                        <div class='listDetails'>
                            <h4><a href="{{ $location->loc_url }}">{{ $location->name }}</a></h4>
                            <li class='noBullets'>{{ $location->address }}, {{ $location->city }}, {{ $location->state }},
                                {{ $location->country }}</li>
                            <br>
                            <li class='noBullets'>{{ $location->description }}</li>
                            <br>
                            <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
                                <a href='/pages/{{ $location->name }}/reviews'>Check out Reviews for
                                    {{ $location->name }}</a>
                            </div>
                            <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
                                <a href='/list/{{ $location->name }}/add'>Add {{ $location->name }} to your list</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    @if ($places == 'null')
        <div class='discover'>
            <h5>We didn't find any results for {{ $city }}. Please try a differnt <a
                    href="/pages/discover/cities">search</a> or add a <a href="/pages/addLocation/new">new
                    location</h5>
        </div>
    @else
        @foreach ($places as $place)
            @if (!$place['properties']['name'])
            @else
                <div class='discover'>
                    <div class='row'>
                        <div class='col'>
                            <h4><a class="nav-link"
                                    href="https://www.google.com/search?q={{ $place['properties']['name'] }}{{ $city }}">{{ $place['properties']['name'] }}</a>
                            </h4>
                        </div>
                        <div class='d-grid
                            gap-2 d-md-flex justify-content-md-end'>
                            <a
                                href='/list/{{ $place['geometry']['coordinates'][1] }}/{{ $place['geometry']['coordinates'][0] }}/{{ $place['properties']['name'] }}/add'>Add
                                to list</a>
                        </div>
                        <ul>
                            <li name='long' class='hide'>{{ $place['geometry']['coordinates'][0] }} </li>
                            <li name='lat' class='hide'>{{ $place['geometry']['coordinates'][1] }} </li>
                        </ul>
                    </div>
                </div>
            @endif
        @endforeach
    @endif
@endsection
