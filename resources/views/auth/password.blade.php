@extends('layouts.auth')

<form method="POST" action="/password/email" class="form-signin">

    <h2 class="form-signin-heading">Reset password</h2>

    {!! csrf_field() !!}

    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <label for="email" class="sr-only">Email address</label>
    <input class="form-control" type="email" name="email" value="{{ old('email') }}" id="email" placeholder="Email address" required autofocus />
    <button type="submit" class="btn btn-block btn-primary">
        Send Password Reset Link
    </button>

    <a
            class="btn btn-lg btn-default btn-block btn-lost-password"
            href="{{ action('Controllers\Auth\AuthController@getLogin') }}">Return</a>
</form>