@extends('layouts.app')

@section('content')

<div class="screen screen__front">
    <div class="head">
        <a href="{{ route('frontpage') }}"><img class="head__image" src="/assets/robin_assistant.svg" alt="Robin Assistant"></a>
    </div>
    <form id="form" class="form" method="POST" action="{{ route('password.confirm') }}">
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
        <span class="form__field form__field--password @error('password') form__field--error @enderror"><input id="form__field--password" type="password" name="password" placeholder="Password" minlength="8" max="1000" required></span>
        <input class="btn" type="submit" value="Log In">
        <a href="{{ route('password.request') }}" class="link">Forgot password?</a>
    </form>
</div>

@endsection
