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
    <div class="header">
        <a href="#navigation" class="hamburger-menu"><img src="/assets/hamburger_primary.svg" alt=""></a>  <!-- TODO -->
        <p class="screen__title">{{$selected_date->format('M')}}</p>
        <a href="#calander" class="calander"><img src="/assets/calander_green.svg" alt=""></a> <!-- TODO -->
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
