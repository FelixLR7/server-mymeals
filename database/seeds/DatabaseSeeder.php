<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(WeekdaySeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(WeekdayScheduleSeeder::class);
        $this->call(MealSeeder::class);
        // $this->call(UserSeeder::class);
        // $this->call(UserCategorySeeder::class);
        // $this->call(MealSchedulingSeeder::class);
        // $this->call(DaySeeder::class);
    }
}
