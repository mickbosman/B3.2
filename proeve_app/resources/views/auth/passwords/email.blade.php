@extends('layouts.app')

@section('content')

<div class="screen screen__front">
    <div class="head">
        <a href="{{ route('frontpage') }}"><img class="head__image" src="/assets/robin_assistant.svg" alt="Robin Assistant"></a>
    </div>
    <form id="form" class="form" method="POST" action="{{ route('password.email') }}">
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
        <span class="form__field form__field--email @error('email') form__field--error @enderror"><input id="form__field--email" type="email" name="email" placeholder="Email" minlength="8" max="1000" required></span>
        <input class="btn" type="submit" value="Send Email">
        <a href="{{ route('login') }}" class="link">or Login</a>
    </form>
</div>

@endsection
