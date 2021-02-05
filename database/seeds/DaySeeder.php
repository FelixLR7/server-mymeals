<?php

use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::first();
        $date = date('Y-m-d');

        $schedulings = App\MealScheduling::all();
        $days = array();

        foreach ($schedulings as $scheduling) {
            $days[] = new App\Day([
                'user_id' => $user->id,
                'date' => $date,
                'meals_scheduling_id' => $scheduling->id
            ]);

            
            $date = date('Y-m-d', strtotime($date. ' + 10 days')); 
        }
        Log::info($days);
        $user->days()->saveMany($days);
    }
}
