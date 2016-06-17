@extends('layouts.auth')

@section('content')

    <form method="POST" action="/auth/polpo" class="form-signin">

        <h2 class="form-signin-heading">Please sign in</h2>
        <p>Use your Polpo credentials.</p>

        @if (count($errors) > 0)
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {!! csrf_field() !!}

        <label for="username" class="sr-only">Polpo username</label>
        <input type="name" name="username" value="{{ old('username') }}" id="username" class="form-control" placeholder="Polpo username" required autofocus />

        <label for="password" class="sr-only">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required />

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <a
            class="btn btn-lg btn-default btn-block btn-lost-password"
            href="{{ action('Controllers\Auth\AuthController@getLogin') }}">Return</a>

    </form>

@endsection