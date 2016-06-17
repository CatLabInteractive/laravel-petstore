@extends('layouts.auth')

<form method="POST" action="/auth/register" class="form-signin register">
    {!! csrf_field() !!}

    <h2 class="form-signin-heading">Register</h2>

    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <label for="name" class="sr-only">Name</label>
    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" placeholder="Name" required autofocus />

    <label for="email" class="sr-only">Email</label>
    <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="Email" required autofocus />

    <label for="password" class="sr-only">Password</label>
    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required />

    <label for="repeat-password" class="sr-only">Confirm Password</label>
    <input type="password" name="password_confirmation" id="repeat-password" class="form-control confirm-password" placeholder="Confirm password" required>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>

    <a
        class="btn btn-lg btn-default btn-block btn-lost-password"
        href="{{ action('Controllers\Auth\AuthController@getLogin') }}">Return</a>
</form>