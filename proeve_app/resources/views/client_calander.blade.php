<?php use Carbon\Carbon; ?>

@extends('layouts.app')

@section('content')

<div class="screen screen__client-calander">
    <div class="header">
        <a href="#navigation" class="hamburger-menu"><img src="/assets/hamburger_primary.svg" alt=""></a>
        <p class="screen__title">Month</p>
        <a href="#calander" class="calander"><img src="/assets/calander_green.svg" alt=""></a>
    </div>
    <div class="navigator">
        <div class="navigator__navigation">
            <a href="" class="arrow arrow--left"><img src="/assets/arrow_right_primary.svg" alt=""></a>
            <p class="calander-day">{{Carbon::now()->format('D')}}</p>
            <a href="" class="arrow arrow--right"><img src="/assets/arrow_right_primary.svg" alt=""></a>
        </div>
    </div>
    <div class="content">
        <table class="calander-table">
            <tbody>
                @for ($i = 1; $i <= 24; $i++)
                <tr @if(Carbon::now()->format('H') == sprintf("%02d", $i)) class="row__current" @endif>
                    <td class="col__time" style="width: 58px">{{sprintf("%02d", $i)}}:00</td>
                    <td class="col__activities"></td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>

@endsection
