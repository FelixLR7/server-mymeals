<?php

use Illuminate\Database\Seeder;

class WeekdaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $weekdays = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

        foreach($weekdays as $weekday) {
            DB::table('weekdays')->insert([
                'name' => $weekday
            ]);

        }
    }
}
