@extends('layouts/main')

@section('content')
    <div class='addressForm'>
        <h1>Register</h1>

        Already have an account? <a href='/login'>Login here...</a>
        <br>
        <br>
        <form method='POST' action='/register'>
            {{ csrf_field() }}
            <div class="mb-3">
                <label class="form-label" for='name'>Name</label>
                <input class="form-control" id='name' type='text' name='name' value='{{ old('name') }}' autofocus>
            </div>
            {{-- @include('includes.error-field', ['fieldName' => 'name']) --}}

            <div class="mb-3">
                <label class="form-label" for='email'>E-Mail Address</label>
                <input class="form-control" id='email' type='email' name='email' value='{{ old('email') }}'>
            </div>
            {{-- @include('includes.error-field', ['fieldName' => 'email']) --}}

            <div class="mb-3">
                <label class="form-label" for='password'>Password (min: 8)</label>
                <input class="form-control" id='password' type='password' name='password'>
            </div>
            {{-- @include('includes.error-field', ['fieldName' => 'password']) --}}

            <div class="mb-3">
                <label for='password-confirm'>Confirm Password</label>
                <input class="form-control" id='password-confirm' type='password' name='password_confirmation'>
            </div>

            <button type='submit' class='btn btn-primary'>Register</button>
        </form>
    </div>
@endsection
