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
                <p class="details__name">{{auth()->user()->name}}</p>
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
        <a href="/home#now" class="calander cursor-pointer"><img src="/assets/calander_green.svg" alt=""></a>
    </div>
    <div class="navigator">
        <div class="navigator__navigation">
            <a href="/home?date={{$previous_day->format('d-m-Y')}}" class="arrow arrow--left"><img src="/assets/arrow_right_primary.svg" alt=""></a>
            <p class="calander-day">{{$selected_date->format('D')}}</p>
            <a href="/home?date={{$next_day->format('d-m-Y')}}" class="arrow arrow--right"><img src="/assets/arrow_right_primary.svg" alt=""></a>
        </div>
    </div>
    <div class="content">
        <div class="modal" id="video-modal">
            <div class="modal-box">
                <div class="modal-head">
                    <img src="/assets/check_green.svg" id="modal-icon" alt="">
                    <p class="head__title" id="modal-title">N/a</p>
                    <a class="head__title-close_btn cursor-pointer" onclick="prevModal()"><img src="/assets/cross_primary.svg" alt=""></a>
                </div>
                <div class="modal-content">
                    <video class="content__video" id="modal-video" src="" controls controlsList="nodownload nofullscreen noremoteplayback"></video>
                </div>
            </div>
        </div>
        <div class="modal" id="listen-modal">
            <div class="modal-box">
                <div class="modal-head">
                    <img src="/assets/check_green.svg" id="modal-icon" alt="">
                    <p class="head__title" id="modal-title">N/a</p>
                    <a class="head__title-close_btn cursor-pointer" onclick="prevModal()"><img src="/assets/cross_primary.svg" alt=""></a>
                </div>
                <div class="modal-content">
                    <audio class="content__audio" id="modal-audio" src="" controls controlsList="nodownload"></audio>
                </div>
            </div>
        </div>
        <div class="modal" id="activity-modal">
            <div class="modal-box">
                <div class="modal-head modal-head--no_bottom">
                    <img src="/assets/check_green.svg" id="modal-icon" alt="">
                    <p class="head__title" id="modal-title">N/a</p>
                    <a class="head__title-close_btn cursor-pointer" onclick="closeModal()"><img src="/assets/cross_primary.svg" alt=""></a>
                </div>
                <div class="modal-content">
                    <div class="content__grid">
                        <div class="grid__actions">
                            <a id="listen-btn"><img src="/assets/sound_primary.svg" class="modal-action_btn modal-action_btn--listen" alt=""></a>
                            <a id="play-btn"><img src="/assets/play_primary.svg" class="modal-action_btn modal-action_btn--view" alt=""></a>
                        </div>
                        <div class="grid__details">
                            <p class="details__period" id="modal-period">From 0:00 to 0:00</p>
                            <p class="details__description" id="modal-description">N/a</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table class="calander-table">
            <tbody>
                @for ($i = 0; $i <= 23; $i++)
                <tr @if($selected_date->format('H') == sprintf("%02d", $i) && $selected_date->isToday()) class="row__current" id="now" @endif>
                    <td class="col__time" style="width: 58px">{{sprintf("%02d", $i)}}:00</td>
                    <td class="col__activities">
                        <?php
                        $date = Carbon::parse($selected_date);
                        $date->setTime($i, 0);
                        ?>
                        @foreach ($client->hour_activities($date) as $activity)
                            <a onclick="openModal('{{$activity->name}}', '{{$activity->description}}', '{{Carbon::parse($activity->begin_time)->format('H:i')}}', '{{Carbon::parse($activity->end_time)->format('H:i')}}', '{{$activity->sound_src}}', '{{$activity->video_src}}', '{{$activity->icon_src}}');"><span class="activities__activity">{{$activity->name}}</span></a>  
                        @endforeach
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>

@endsection
