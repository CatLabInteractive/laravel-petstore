@extends('layouts.auth')

@section('content')

        <form method="POST" action="/auth/login" class="form-signin">

            <h2 class="form-signin-heading">Please sign in</h2>

            @if (count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            {!! csrf_field() !!}

            <label for="email" class="sr-only">Email address</label>
            <input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control" placeholder="Email address" required autofocus />

            <label for="password" class="sr-only">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required />

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> Remember Me
                </label>
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

            <a
                class="btn btn-lg btn-default btn-block btn-register"
                href="{{ action('Controllers\Auth\AuthController@getRegister') }}">Register</a>

            <a
                class="btn btn-lg btn-default btn-block btn-lost-password"
                href="{{ action('Controllers\Auth\PasswordController@getEmail') }}">Lost password</a>

        </form>

@endsection