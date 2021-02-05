<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('days', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date('date');
            $table->unsignedBigInteger('meal_id');
            $table->unsignedBigInteger('schedule_id');
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('meal_id')->references('id')->on('meals')->onUpdate('cascade');
            $table->foreign('schedule_id')->references('id')->on('schedules')->onUpdate('cascade');
            $table->unique(['user_id', 'date', 'schedule_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('days');
    }
}
