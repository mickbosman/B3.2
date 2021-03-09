<?php 
use Carbon\Carbon; 

$selected_date = Carbon::now();
if(isset($_GET['date'])) $selected_date = Carbon::parse($_GET['date']);

$selected_date->setTime(Carbon::now()->format('H'), Carbon::now()->format('i'), Carbon::now()->format('s'));

$next_day = Carbon::parse($selected_date)->addDay();
$previous_day = Carbon::parse($selected_date)->subDay();

?>

@extends('layouts.app')

@section('content')

<div class="screen screen__client-calander">
    <div class="navigation" id="navigation">
        <a class="close_btn cursor-pointer" onclick="closeMenu()"><img src="/assets/cross_primary.svg" alt=""></a>
        <div class="current_profile">
            <img src="@if(auth()->user()->current_client->profile_picture == null) /assets/user_white.svg @else {{auth()->user()->current_client->profile_picture}} @endif" alt="" class="profile__picture">
            <div class="profile__details">
                <p class="details__name">{{auth()->user()->current_client->firstname}} {{auth()->user()->current_client->lastname}}</p>
                <div class="details__table details__table--birth">
                    <span>Born:</span>
                    <span class="row__value">{{Carbon::parse(auth()->user()->current_client->birth)->format('m-d-Y')}}</span>
                </div>
                <div class="details__table details__table--monitor">
                    <span>Monitor:</span>
                    <span class="row__value">{{auth()->user()->name}}</span>
                </div>
            </div>
        </div>
        <p class="profile__title">Monitor</p>
        <div class="monitor__profile">
            <img src="/assets/user_white.svg" alt="" class="profile__picture">
            <div class="profile__details">
                <p class="details__name">{{auth()->user()->current_client->firstname}} {{auth()->user()->current_client->lastname}}</p>
                <div class="details__table details__table--email">
                    <span>Email:</span>
                    <span class="row__value table__row--lower">{{auth()->user()->email}}</span>
                </div>
                @if(auth()->user()->phone !== null)
                <div class="details__table details__table--phone">
                    <span>Tel:</span>
                    <span class="row__value table__row--lower">{{auth()->user()->phone}}</span>
                </div>
                @endif
            </div>
        </div>
        <button class="btn btn--panic">Panic button</button>
    </div>
    <div class="header">
        <a class="hamburger-menu cursor-pointer" onclick="openMenu()"><img src="/assets/hamburger_primary.svg" alt=""></a>
        <p class="screen__title">{{$selected_date->format('M')}}</p>
        <a class="calander cursor-pointer"><img src="/assets/calander_green.svg" alt=""></a> <!-- TODO -->
    </div>
    <div class="navigator">
        <div class="navigator__navigation">
            <a href="/home?date={{$previous_day->format('d-m-Y')}}" class="arrow arrow--left"><img src="/assets/arrow_right_primary.svg" alt=""></a>
            <p class="calander-day">{{$selected_date->format('D')}}</p>
            <a href="/home?date={{$next_day->format('d-m-Y')}}" class="arrow arrow--right"><img src="/assets/arrow_right_primary.svg" alt=""></a>
        </div>
    </div>
    <div class="content">
        <table class="calander-table">
            <tbody>
                @for ($i = 0; $i <= 23; $i++)
                <tr @if($selected_date->format('H') == sprintf("%02d", $i) && $selected_date->isToday()) class="row__current" @endif>
                    <td class="col__time" style="width: 58px">{{sprintf("%02d", $i)}}:00</td>
                    <td class="col__activities">
                        <?php
                        $date = Carbon::parse($selected_date);
                        $date->setTime($i, 0);
                        ?>
                        @foreach ($client->hour_activities($date) as $activity)
                            <a href="#task"><!-- TODO --><span class="activities__activity">{{$activity->name}}</span></a>  
                        @endforeach
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>

@endsection
