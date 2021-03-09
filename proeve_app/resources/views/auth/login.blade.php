@extends('layouts.app')

@section('content')

<div class="screen screen__front">
    <div class="head">
        <a href="{{ route('frontpage') }}"><img class="head__image" src="/assets/robin_assistant.svg" alt="Robin Assistant"></a>
    </div>
    <form id="form" class="form" method="POST" action="{{ route('login') }}">
        @csrf
        <span class="form__field form__field--email @error('password') form__field--error @enderror"><input id="form__field--email" type="email" name="" class="" value="{{ old('email') }}" placeholder="Email" minlength="6" max="255" required autofocus></span>
        <span class="form__field form__field--password @error('password') form__field--error @enderror"><input id="form__field--password" type="password" name="" class="" placeholder="Password" minlength="10" max="1000" required></span>
        <input class="btn" type="submit" value="Log In">
        <a href="{{ route('password.request') }}" class="link">Forgot password?</a>
    </form>
</div>

@endsection
