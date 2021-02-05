<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveMealRequest;
use App\{Meal, MealScheduling};
use Illuminate\Http\Request;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        return response()->json($user->mealsByWeekdayAndSchedule(1, 3));

        // $meals = $request->user()->meals;
        
        // return response()->json($meals);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveMealRequest $request)
    {
        $response = $this->saveMeal($request);

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function show(Meal $meal)
    {
        return response()->json($meal);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function update(SaveMealRequest $request, Meal $meal)
    {
        $meal->scheduling()->delete();

        $response = $this->saveMeal($request, $meal);

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meal $meal)
    {
        $meal->delete();
        $response = array('success' => true, 'message' => 'La comida se ha borrado correctamente');

        response()->json($response);
    }

    private function saveMeal($request, $meal = null) {
        $success = false;
        $message = "";
        $user = $request->user();

        if(is_null($meal)) {
            $newMeal = new Meal([
                'category_id' => $request->input('category_id'),
                'name' => $request->input('name')
            ]);

            $meal = $user->meals()->save($newMeal);
        }
        else {
            $meal->name = $request->input('name');
            $meal->category_id = $request->input('category_id');

            $meal->save();
        }
        
        $this->createSchedulings($user, $meal->id, $request->input('weekdays'), $request->input('schedules'));

        $success = true;
        $message = "Tu comida se ha guardado correctamente";

        return array('success' => $success, 'message' => $message);
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
