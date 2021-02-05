<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlreadyEatensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('already_eatens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('meal_id');
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('meal_id')->references('id')->on('meals')->onDelete('cascade');
            $table->unique(['user_id', 'meal_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('already_eatens');
    }
}
