<?php

use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schedules = ['Desayuno', 'Almuerzo', 'Comida', 'Merienda', 'Cena'];

        foreach($schedules as $schedule) {
            DB::table('schedules')->insert([
                'name' => $schedule
            ]);

        }
    }
}
