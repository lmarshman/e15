@extends('layouts/main')

@section('head')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href='/css/cityRoutes.css' rel='stylesheet'>
@endsection

@section('content')
    <h2 class='addressHeader'>Enter Locations</h2>

    <div class='addressForm'>
        <form method='GET' action='/routes/address'>

            {{ csrf_field() }}

            <div class="mb-3">
                <label class="form-label" for='start'>Enter the starting address:</label>
                <input type='text' class="form-control" name='start' id='start' value='{{ old('start') }}'>
            </div>

            <label for='loc1'>Choose a location</label>
            <select test='location1-dropdown' name='loc1'>
                <option value=''>Choose one...</option>
                @foreach ($locations as $location)
                    <option value='{{ $location->id }}' {{ old('loc1') == $location->id }}>
                        {{ $location->city . ' - ' . $location->name }}
                    </option>
                @endforeach
            </select>

            <div class="mb-3">
                <label for='loc2'>Choose a location</label>
                <select test='location2-dropdown' name='lo2'>
                    <option value=''>Choose one...</option>
                    @foreach ($locations as $location)
                        <option value='{{ $location->id }}' {{ old('loc2') == $location->id }}>
                            {{ $location->city . ' - ' . $location->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for='loc3'>Choose a location</label>
                <select class="form-select" test='location-dropdown' name='lo3'>
                    <option value=''>Choose one...</option>
                    @foreach ($locations as $location)
                        <option value='{{ $location->id }}'
                            {{ (old('loc3') == $location->id or isset($location->id) and $location->id == $location->id) ? 'selected' : '' }}>
                            {{ $location->city . ' - ' . $location->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label" for='loc4'>Choose a location</label>
                <select class="form-select" test='location-dropdown' name='lo4'>
                    <option value=''>Choose one...</option>
                    @foreach ($locations as $location)
                        <option value='{{ $location->id }}'
                            {{ (old('loc4') == $location->id or isset($location->id) and $location->id == $location->id) ? 'selected' : '' }}>
                            {{ $location->city . ' - ' . $location->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for='loc5'>Choose a location</label>
                <select class="form-select" test='location-dropdown' name='lo5'>
                    <option value=''>Choose one...</option>
                    @foreach ($locations as $location)
                        <option value='{{ $location->id }}'
                            {{ (old('loc5') == $location->id or isset($location->id) and $location->id == $location->id) ? 'selected' : '' }}>
                            {{ $location->city . ' - ' . $location->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type='submit' class='btn btn-primary'>Get Route!</button>

            @if (count($errors) > 0)
                <ul class='alert alert-danger'>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

        </form>
    </div>
@endsection
