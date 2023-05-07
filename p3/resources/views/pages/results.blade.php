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
                        <img src="{{ $location->picture_url }}" alt="{{ $location->name }}" width="250" height="200">
                    </div>
                    <div class='col'>
                        <h4><a class="nav-link" href="{{ $location->loc_url }}">{{ $location->name }}</a>
                        </h4>
                        <ul>
                            <li>{{ $location->address }}, {{ $location->city }}, {{ $location->state }},
                                {{ $location->country }}</li>
                            <li>{{ $location->description }}</li>
                        </ul>
                        <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
                            <button type='button' class="btn btn-primary me-md-2"><a href=''></a>Add
                                this location to your List</button>
                        </div>
                    </div>
                    <ul>
                        <li name='long' class='hide'>{{ $location->long }} </li>
                        <li name='lat' class='hide'>{{ $location->lat }} </li>
                    </ul>
                </div>
            </div>
        @endforeach
    @endif

    @if ($places == 'null')
        <div class='discover'>
            <h5>We didn't find any results for {{ $city }}. Please try a differnt <a class="nav-link"
                    href="/pages/discover/cities">search</a> or add a <a class="nav-link" href="/pages/addLocation/new">new
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
                        <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
                            <button type='button' class="btn btn-primary me-md-2"><a href=''></a>Add
                                this location to your List</button>
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
