<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [ 'name' => 'Carne'], 
            [ 'name' => 'Pescado'], 
            [ 'name' => 'Pasta'], 
            [ 'name' => 'Legumbres'], 
            [ 'name' => 'Otros']
        ];

        DB::table('categories')->insert($categories);
    }
}
