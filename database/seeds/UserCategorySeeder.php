<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Log;

class UserCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = App\Category::pluck('id')->take(3);
        $user = App\User::first();
    
        foreach ($categories as $category) {
            App\UserCategory::create([
                'category_id' => $category,
                'user_id' => $user->id
            ]);
        }
    }
}