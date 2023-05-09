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
                <input test="name-input" class="form-control" id='name' type='text' name='name'
                    value='{{ old('name') }}' autofocus>
                @include('includes.error-field', ['fieldName' => 'name'])
            </div>

            <div class="mb-3">
                <label class="form-label" for='email'>E-Mail Address</label>
                <input test="email-input" class="form-control" id='email' type='email' name='email'
                    value='{{ old('email') }}'>
                @include('includes.error-field', ['fieldName' => 'email'])
            </div>

            <div class="mb-3">
                <label class="form-label" for='password'>Password (min: 8)</label>
                <input test="password-input" class="form-control" id='password' type='password' name='password'>
                @include('includes.error-field', ['fieldName' => 'password'])
            </div>

            <div class="mb-3">
                <label for='password-confirm'>Confirm Password</label>
                <input test=password-confirmation-input class="form-control" id='password-confirm' type='password'
                    name='password_confirmation'>
            </div>

            <button test="register-button" type='submit' class='btn btn-primary'>Register</button>
        </form>
    </div>
@endsection
