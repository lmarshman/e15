@extends('layouts/main')

@section('head')
    <link href='/css/cityRoutes.css' rel='stylesheet'>
@endsection

@section('content')
    <h2>Enter Locations</h2>

    <div class='addressForm'>
        <form method='GET' action='/routes/address'>

            <fieldset>
                <label for='start'>
                    Enter the starting address:
                    <input type='text' name='start' value='{{ old('start') }}'>
                </label>
            </fieldset>

            <fieldset>
                <label for='loc1'>
                    Enter your first location:
                    <input type='text' name='loc1' value='{{ old('loc1') }}'>
                </label>
            </fieldset>

            <fieldset>
                <label for='loc2'>
                    Enter your second location:
                    <input type='text' name='loc2' value='{{ old('loc2') }}'>
                </label>
            </fieldset>


            <button type='submit' class='btn btn-primary'>Get Route!</button>

        </form>
    </div>
@endsection
