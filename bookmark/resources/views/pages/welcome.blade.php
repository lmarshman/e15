@extends('layouts/main')

@section('content')
    @livewireStyles
    @livewireScripts
    <p>How many books would you like to read this year?</p>
    <livewire:counter />
    <p>Welcome to Bookmark. Please check back later.</p>
@endsection
