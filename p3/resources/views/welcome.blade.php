<!DOCTYPE html>
@extends('layouts/main')

@section('title')
    CityRoutes
@endsection

@section('content')
    {{-- <div class="intro">
        <h5>Welcome to CityRoutes! Your tool for keeping track of the places you want to visit, and the best route to visit
            them all!</h5>
    </div> --}}

    <div>
        <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
            <div class="col-md-6 px-0">
                <h1 class="display-4">CityRoutes</h1>
                <p class="lead my-6">Welcome to CityRoutes! Your tool for keeping track of the places you want to visit, and
                    the best route to visit
                    them all!
                </p>
                <p class="lead mb-0"><a href="" class="text-white fw-bold">Sign In to start making your own lists</a>
                </p>
            </div>
        </div>
        <br>
        <div class="row mb-2 left-border">
            <div class="card cardSpacing" style="width:350px">
                <div class="card-body">
                    <h4 class="card-title">My Cities</h4>
                    <p class="card-text">View your cities</p>
                    <a href="/discover" class="btn btn-primary">View your lists</a>
                </div>
            </div>
            <div class="card cardSpacing" style="width:350px">
                <div class="card-body">
                    <h4 class="card-title">Discover</h4>
                    <p class="card-text">Find new places!</p>
                    <a href="/developers" class="btn btn-primary">Browse Cities</a>
                </div>
            </div>
            <div class="card cardSpacing" style="width:350px">
                <div class="card-body">
                    <h4 class="card-title">Explore</h4>
                    <p class="card-text">Add new places to your existing lists</p>
                    <a href="/searchgame" class="btn btn-primary">Add new things to your existing lists</a>
                </div>
            </div>
        </div>

    </div>
@endsection
