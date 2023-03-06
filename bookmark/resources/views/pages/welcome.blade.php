@extends('layouts/main')

@section('content')
    @livewireStyles
    @livewireScripts
    <livewire:counter />
    <p>Welcome to Bookmark. Please check back later.</p>
@endsection
