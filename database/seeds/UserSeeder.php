<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\User::class, 1)->create()->each(function ($user) {
        //     $meals = factory(App\Meal::class, 3)->make();
        //     $user->meals()->saveMany($meals);
        // });

        DB::table('users')->insert([
            'name' => 'Félix',
            'email' => 'felix@gmail.com',
            'password' => Hash::make('123')
        ]);
    }
}
