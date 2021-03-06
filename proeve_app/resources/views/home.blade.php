@extends('layouts.app')

@section('content')

<div class="screen screen__client-selector">
    <div class="head">
        <a href="{{ route('frontpage') }}"><img class="head__image" src="/assets/robin_assistant.svg" alt="Robin Assistant"></a>
    </div>
    <h2 class="page-title">Choose your client</h2>
    <div class="clients">
        @foreach (auth()->user()->clients as $client)
            <div onclick="selectClient({{$client->id}})" class="clients__client-box">
                <img src="@if($client->profile_picture == null) /assets/user_white.svg @else {{$client->profile_picture}} @endif" alt="" class="client__image">
                <p class="client__name">{{$client->firstname}} {{$client->lastname}}</p>
                <label class="container">
                    <input class="client-selected" type="radio" id="client-{{$client->id}}" data-client_id="{{$client->id}}" name="client-selected">
                    <span class="checkmark"></span>
                </label>
            </div>
        @endforeach
    </div>
    <div class="actions">
        <button onclick="clientSelectionFetcher()" class="btn">Continue</button>
        <a href="{{ route('logout_get') }}" class="link">Logout</a>
    </div>
</div>

<script>

    function selectClient(client_id) { // Allows clicking the entire element for checkbox check
        var radioElem = document.getElementById('client-'+client_id);
        if(radioElem.checked) { 
            radioElem.checked = false 
        } else { 
            radioElem.checked = true 
        }
    }

    function clientSelectionFetcher() { // Looks for selected client to continue with
        var selectors = document.querySelectorAll('.client-selected');

        selectors.forEach(radio => {
            if(radio.checked) location.href = "/home/clients/"+radio.dataset.client_id+"/control";
        });
    }

</script>

@endsection
