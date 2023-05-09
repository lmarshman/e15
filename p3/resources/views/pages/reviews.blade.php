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

    <h3 class='reviewsHeader'>Check out reviews for {{ $location->name }}</h3>

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
                        <a href='/list/{{ $location->name }}/add'>Add {{ $location->name }} to your list</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class='reviewForm'>
        <form method='POST' action='/pages/{{ $location->name }}/reviews/add'>

            {{ csrf_field() }}

            <div class="mb-3">
                <h5>Write a review for {{ $location->name }}</h5>
                <p>What did you think? Would you go again? Any tips or fun facts?</p>
                <textarea type='textarea' class="form-control" name='review' id='review' rows="4"
                    value='{{ old('review') }}'></textarea>
            </div>
            <button type='submit' test='create-review-link' class='btn btn-primary'>Post Review</button>

            @if (count($errors) > 0)
                <ul class='alert alert-danger'>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </form>
    </div>

    <h3 class='reviews'>User Reviews</h3>

    @if (!$reviews)
        <h5 class='reviewsHeader'>It looks like there aren't any reviews for this location. Be the first user to add one!
        </h5>
    @else
        @foreach ($reviews as $review)
            <div class='discover'>
                <div class='listDetails'>
                    <h4>{{ $review->name }}</h4>
                    <h6>{{ $review->created_at }}</h6>
                    <br>
                    <li class='noBullets'>{{ $review->body }}</li>
                </div>
            </div>
        @endforeach
    @endif
@endsection
