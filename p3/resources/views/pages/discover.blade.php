<!DOCTYPE html>
@extends('layouts/main')

@section('title')
    CityRoutes
@endsection

@section('content')
    <div class='addressForm'>
        <h1>Discover new places</h2>
            <form method='GET' action='/pages/discover'>
                <fieldset>
                    <label for='city'>
                        What city would you like to explore?
                        <input type='text' name='city' value='{{ old('city') }}'>
                    </label>
                </fieldset>

                <button type='submit' class='btn btn-primary'>Discover!</button>
            </form>
    </div>
@endsection
