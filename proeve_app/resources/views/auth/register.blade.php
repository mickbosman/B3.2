@extends('layouts.app')

@section('content')

<div class="screen screen__front">
    <div class="head">
        <a href="{{ route('frontpage') }}"><img class="head__image" src="/assets/robin_assistant.svg" alt="Robin Assistant"></a>
    </div>
    <form id="form" class="form" method="POST" action="{{ route('register') }}">
        @if (session('status'))
            <p class="feedback feedback--valid" role="alert">
                {{ session('status') }}
            </p>
        @endif
        <div class="feedback feedback--invalid" role="alert">
            @if($errors->any())
                {!! implode('', $errors->all('<p>:message</p>')) !!}
            @endif
        </div>
        
        @csrf
        <span class="form__field form__field--name @error('name') form__field--error @enderror"><input id="form__field--name" type="text" name="name" value="{{ old('name') }}" placeholder="Name" minlength="4" max="255" required autofocus></span>
        <span class="form__field form__field--email @error('password') form__field--error @enderror"><input id="form__field--email" type="email" name="email" value="{{ old('email') }}" placeholder="Email" minlength="6" max="255" required></span>
        <span class="form__field form__field--password @error('password') form__field--error @enderror"><input id="form__field--password" type="password" name="password" placeholder="Password" minlength="8" max="1000" required></span>
        <span class="form__field form__field--password_confirm @error('password_confirmation') form__field--error @enderror"><input id="form__field--password_confirm" type="password" name="password_confirmation" placeholder="Repeat Password" minlength="8" max="1000" required></span>
        <input class="btn" type="submit" value="Register">
        <a href="{{ route('login') }}" class="link">or Log In</a>
    </form>
</div>

@endsection