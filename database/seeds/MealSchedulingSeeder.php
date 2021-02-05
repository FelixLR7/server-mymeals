<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class MealSchedulingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::first();
        $meals = App\Meal::all();
        $weekdaySchedule = App\WeekdaySchedule::all();
        $keys = $weekdaySchedule->modelKeys();

        foreach ($meals as $meal) {
            for($i = 1; $i < 3; $i++) {

                DB::table('meal_schedulings')->insert([
                    'user_id' => $user->id,
                    'meal_id' => $meal->id,
                    'weekday_schedule_id' => $keys[$i-1]
                ]);
            }
        }
    }
}
