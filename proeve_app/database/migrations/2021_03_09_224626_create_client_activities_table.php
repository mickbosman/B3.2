<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientActivitiesTable extends Migration
{
    public function up()
    {
        Schema::create('client_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id'); // Client
            $table->unsignedBigInteger('user_id'); // Caretaker
            $table->string('name');
            $table->string('description');
            $table->time('begin_time');
            $table->time('end_time');
            $table->string('icon_src');
            $table->string('sound_src')->nullable();
            $table->string('video_src')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_activities');
    }
}
