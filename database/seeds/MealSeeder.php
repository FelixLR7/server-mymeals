<?php

use Illuminate\Database\Seeder;
use App\{Meal, MealScheduling, User};

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meals = json_decode('[
        {
            "name" : "Entrecot",
            "category_id" : "1",
            "weekdays" : [1, 2, 3, 4, 5],
            "schedules" : [3]
        },
        {
            "name" : "Bocadillo de bacon",
            "category_id" : "1",
            "weekdays" : [1, 2, 3, 4, 5, 6, 7],
            "schedules" : [2, 3, 4, 5]
        },
        {
            "name" : "Pollo",
            "category_id" : "2",
            "weekdays" : [1, 2, 3, 4, 5, 6, 7],
            "schedules" : [3, 5]
        },
        {
            "name" : "Lomo",
            "category_id" : "1",
            "weekdays" : [1, 2, 3, 4, 5, 6, 7],
            "schedules" : [3, 5]
        },
        {
            "name" : "Embutidos varios",
            "category_id" : "1",
            "weekdays" : [1, 2, 3, 4, 5, 6, 7],
            "schedules" : [5]
        },
        {
            "name" : "Albóndigas",
            "category_id" : "1",
            "weekdays" : [1, 2, 3, 4, 5, 6, 7],
            "schedules" : [3]
        },
        {
            "name" : "Pechuga de pavo",
            "category_id" : "1",
            "weekdays" : [1, 2, 3, 4, 5, 6, 7],
            "schedules" : [3, 5]
        },
        {
            "name" : "Alitas",
            "category_id" : "1",
            "weekdays" : [1, 2, 3, 4, 5, 6, 7],
            "schedules" : [3]
        },
        {
            "name" : "Emperador",
            "category_id" : "2",
            "weekdays" : [6, 7],
            "schedules" : [3, 5]
        },
        {
            "name" : "Merluza",
            "category_id" : "2",
            "weekdays" : [1, 2, 3, 4, 5, 6, 7],
            "schedules" : [3, 5]
        },
        {
            "name" : "Salmón",
            "category_id" : "2",
            "weekdays" : [1, 2, 3, 4, 5],
            "schedules" : [5]
        },
        {
            "name" : "Dorada",
            "category_id" : "2",
            "weekdays" : [6, 7],
            "schedules" : [3, 5]
        },
        {
            "name" : "Pasta con atún",
            "category_id" : "3",
            "weekdays" : [1, 2, 3, 4, 5, 6, 7],
            "schedules" : [3]
        },
        {
            "name" : "Pasta con carne",
            "category_id" : "3",
            "weekdays" : [1, 2, 3, 4, 5, 6, 7],
            "schedules" : [3]
        },
        {
            "name" : "Ensalada de pasta",
            "category_id" : "3",
            "weekdays" : [1, 2, 3, 4, 5, 6, 7],
            "schedules" : [3]
        },
        {
            "name" : "Lentejas",
            "category_id" : "4",
            "weekdays" : [1, 2, 3, 4, 5, 6, 7],
            "schedules" : [3]
        },
        {
            "name" : "Potage",
            "category_id" : "4",
            "weekdays" : [1, 2, 3, 4, 5, 6, 7],
            "schedules" : [3]
        },
        {
            "name" : "Habichuelas",
            "category_id" : "4",
            "weekdays" : [1, 2, 3, 4, 5, 6, 7],
            "schedules" : [3]
        }]', true);

        $user = User::find(1);

        foreach ($meals as $meal) {
            $newMeal = new Meal([
                'category_id' => $meal['category_id'],
                'name' => $meal['name']
            ]);

            $mealSaved = $user->meals()->save($newMeal);
            
            $this->createSchedulings($user, $mealSaved->id, $meal['weekdays'], $meal['schedules']);
        }        
    }

    private function createSchedulings($user, $mealId, $weekdays, $schedules) {
        foreach($weekdays as $weekday) {
            foreach ($schedules as $schedule) {
                $schedulingMeal = new MealScheduling([
                    'meal_id' => $mealId,
                    'weekday_id' => $weekday,
                    'schedule_id' => $schedule
                ]);

                $user->mealScheduling()->save($schedulingMeal);                    
            }
        }
    }
}
