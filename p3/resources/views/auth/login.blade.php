@extends('layouts/main')

@section('head')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href='/css/cityRoutes.css' rel='stylesheet'>
@endsection

@section('content')
    <div class='addressForm'>
        <h1>Login</h1>
        Don’t have an account? <a href='/register'>Register here...</a>
        <br>
        <br>
        <form method='POST' action='/login'>

            {{ csrf_field() }}
            <div class="mb-3">
                <label class="form-label" for='email'>E-Mail Address</label>
                <input class="form-control" id='email' type='email' name='email' value='{{ old('email') }}'
                    autofocus>
            </div>
            @include('includes.error-field', ['fieldName' => 'email'])

            <div class="mb-3">
                <label class="form-label" for='password'>Password</label>
                <input class="form-control" id='password' type='password' name='password'>
            </div>
            @include('includes.error-field', ['fieldName' => 'password'])

            <div class="mb-3 form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type='checkbox' name='remember' {{ old('remember') ? 'checked' : '' }}>
                    Remember Me
                </label>
            </div>
            <button test='login-button' type='submit' class='btn btn-primary'>Login</button>
        </form>
    </div>
@endsection
