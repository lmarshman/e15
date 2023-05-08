<!DOCTYPE html>
@extends('layouts/main')

@section('title')
    CityRoutes
@endsection

@section('content')
    <div>
        <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
            <div class="col-md-6 px-0">
                <h1 class="display-4">CityRoutes</h1>
                @if (Auth::user())
                    <h2>
                        Hello {{ Auth::user()->name }}!
                    </h2>
                @endif
                <p class="lead my-6">Welcome to CityRoutes! Your tool for keeping track of the places you want to visit, and
                    the best route to visit
                    them all!
                </p>
                @if (!Auth::user())
                    <p class="lead mb-0"><a href="" class="text-white fw-bold">Sign In to start making your own
                            lists</a>
                    </p>
                @endif
            </div>
        </div>
        <br>
        <div class="row mb-2 left-border">
            <div class="card cardSpacing" style="width:350px">
                <div class="card-body">
                    <h4 class="card-title">My Cities</h4>
                    <p class="card-text">View your cities</p>
                    <a href="/list" class="btn btn-primary">View your lists</a>
                </div>
            </div>
            <div class="card cardSpacing" style="width:350px">
                <div class="card-body">
                    <h4 class="card-title">Discover</h4>
                    <p class="card-text">Add new places to your existing lists</p>
                    <a href="/pages/discover/cities" class="btn btn-primary">Find new things to see!</a>
                </div>
            </div>
            <div class="card cardSpacing" style="width:350px">
                <div class="card-body">
                    <h4 class="card-title">Explore</h4>
                    <p class="card-text">Make a Route!</p>
                    <a href="/routes/address/convert" class="btn btn-primary">Go to your places!</a>
                </div>
            </div>
        </div>

    </div>
@endsection
