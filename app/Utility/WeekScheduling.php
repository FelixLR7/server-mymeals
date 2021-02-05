<?php

namespace App\Utility;

use App\{AlreadyEaten, Day};
use Illuminate\Support\Facades\Log;

class WeekScheduling {
    private $user;

    function __construct($user) {
        $this->user = $user;
    }

    public function generateWeek() {
        $this->user->days()->delete();
        
        $weekdaysIds = $this->user->weekdays();

        foreach ($weekdaysIds as $weekdayId) {
            $ok = $this->generateDay($weekdayId);
            Log::info("\n");
        }
    }

    private function generateDay($weekdayId) {
        $schedulesIds = $this->user->schedules();
        Log::info("Entra en generateDay");
        Log::info("Weekday id: " . $weekdayId);

        foreach ($schedulesIds as $scheduleId) {
        Log::info("Schedule id: " . $scheduleId);
        $mealsIds = $this->user->mealsByWeekdayAndSchedule($weekdayId, $scheduleId)->toArray();
        Log::info("Meals id: " . implode(",", $mealsIds));

            if(count($mealsIds)) {
                $alreadyEaten = $this->user->alreadyEatenIds()->toArray();
                Log::info("AlreadyEaten id: " . implode(",", $alreadyEaten));
    
                $meals = array_diff($mealsIds, $alreadyEaten);
                $mealId = null;
    
                if(count($meals)) {
                    Log::info("Entra arriba");
                    
                    $index = array_rand($meals);
                    $mealId = $meals[$index];

                    $alreadyEaten = new AlreadyEaten([
                        'meal_id' => $mealId
                    ]);
    
                    $this->user->alreadyEaten()->save($alreadyEaten);
                }
                else {
                    Log::info("Entra abajo");
                    $index = array_rand($mealsIds);
                    $mealId = $mealsIds[$index];
                    $this->user->alreadyEaten()->whereIn('meal_id', $mealsIds)->delete();
                }
    
                Log::info("Comida elegida: " . $mealId . "\n");

                $day = new Day([
                    'date' => now()->addDay($weekdayId), // Weekdays id's always will be 1 to 7
                    'meal_id' => $mealId,
                    'schedule_id' => $scheduleId
                ]);
    
                $this->user->days()->save($day);
            }
        }
    }

    public function deleteSchedule($id) {

    }
}