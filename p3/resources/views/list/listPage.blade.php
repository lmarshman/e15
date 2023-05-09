<!DOCTYPE html>
@extends('layouts/main')

@section('head')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href='/css/cityRoutes.css' rel='stylesheet'>
@endsection

@section('title')
    My Cities
@endsection

@section('content')
    <h1 test="Location-header" class='listHeader'>My Locations</h1>

    @if ($locations->count() == 0)
        <div class='listNoLoc'>
            <p test='no-books-message'>It looks like you haven't added any locations yet.</p>
            <p>You can search for locations to add by <a href="/pages/discover/cities">city</a> or you can add a <a
                    href="/pages/addLocation/new">new location of your own!</p>
        </div>
    @else
        @foreach ($locations as $location)
            <div class='discover'>
                <div class='row'>
                    <div class='col-md-4'>
                        <img src="{{ $location->picture_url }}" alt="{{ $location->name }}" width="350" height="300">
                    </div>
                    <div class='col'>
                        <div class='listDetails'>
                            <h4><a href="{{ $location->loc_url }}">{{ $location->name }}</a>
                            </h4>
                            <li class='noBullets'>{{ $location->address }}, {{ $location->city }}, {{ $location->state }},
                                {{ $location->country }}</li>
                            <br>
                            <li class='noBullets'>{{ $location->description }}</li>

                            <div class='notes'>
                                <h5>My Notes</h5>
                                <form method='POST' action='/list/{{ $location->name }}/update'>
                                    {{ csrf_field() }}
                                    {{ method_field('put') }}
                                    <div class="mb-3">
                                        <textarea class="form-control" rows="3" name='notes' test='{{ $location->name }}-notes-textarea'>{{ $location->pivot->notes }}</textarea>
                                        <br>
                                        <button type='submit' class='btn btn-primary'
                                            test='{{ $location->name }}-update-button'>Update notes</button>
                                    </div>
                                </form>
                            </div>
                            <div class='d-grid gap-2 d-md-flex justify-content-md-end'>
                                <a href='/list/{{ $location->name }}/delete'>Delete this location from your List</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    {{-- <p class='added'>
            Added {{ $book->pivot->created_at->diffForHumans() }}
        </p>

        @include('includes/remove-from-list')
        </div>
        @endforeach
        @endif --}}
@endsection
