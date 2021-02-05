<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeekdaySchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekday_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('weekday_id');
            $table->unsignedBigInteger('schedule_id');
            
            $table->unique(['user_id', 'weekday_id', 'schedule_id']);
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('weekday_id')->references('id')->on('weekdays')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('schedule_id')->references('id')->on('schedules')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weekday_schedules');
    }
}
