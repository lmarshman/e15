<!DOCTYPE html>
@extends('layouts/main')

@section('title')
    CityRoutes
@endsection

@section('content')
    <div class='addressForm'>
        <h1>Discover new places</h1>
        <form method='GET' action='/pages/discover'>
            <div class="mb-3">
                <label class="form-label" for='city'>
                    What city would you like to explore?
                    <input class="form-control" type='text' name='city' value='{{ old('city') }}'>
                </label>
            </div>
            <button type='submit' class='btn btn-primary'>Discover!</button>
        </form>
    </div>
@endsection
