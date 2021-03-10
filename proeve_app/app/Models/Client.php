<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public function caretaker() {
        return $this->belongsTo(User::class);
    }

    public function activities() {
        return $this->hasMany(ClientActivity::class);
    }

    public function day_activities(string $date = null) {
        $date = Carbon::parse($date);

        $day_activities = [];
        $activities = $this->activities;

        foreach($activities as $activity) if(Carbon::parse($activity->begin_time)->isSameDay($date)) $day_activities[] = $activity;

        return collect($day_activities);
    }

    public function hour_activities(string $date) {
        $date = Carbon::parse($date);

        $period_activities = [];
        $activities = $this->activities;

        foreach($activities as $activity) if(Carbon::parse($activity->begin_time)->isSameHour($date)) $period_activities[] = $activity;

        return collect($period_activities);
    }
}
