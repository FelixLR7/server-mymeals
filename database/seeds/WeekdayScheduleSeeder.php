<?php

use Illuminate\Database\Seeder;

class WeekdayScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $weekdaySchedules = array();

        for($i = 1; $i < 8; $i++) {
            for($j = 1; $j < 6; $j++) {
                if($j != 2 && $j != 4)
                    $weekdaySchedules[] = new App\WeekdaySchedule([
                        'weekday_id' => $i,
                        'schedule_id' => $j
                    ]);
            }
        }

        $user = App\User::first();     
        $user->weekdayschedules()->saveMany($weekdaySchedules);
    }
}
