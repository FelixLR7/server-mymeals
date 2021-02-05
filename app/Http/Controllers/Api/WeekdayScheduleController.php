<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\WeekdaySchedule;
use Illuminate\Http\Request;
use App\Http\Requests\StoreWeekdaySchedulesRequest;


class WeekdayScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWeekdaySchedulesRequest $request)
    {
        $user = $request->user();
        $success = false;
        $message = "";

        $data = $request->input('weekdaySchedules');

        if(!$user->weekdaySchedules->isEmpty()) {
            $user->weekdaySchedules()->delete();
        }
        
        foreach ($data as $key => $value) {
            if(is_array($value)) {
                foreach ($value as $key2) {
                    $scheduling = new WeekdaySchedule([
                        'weekday_id' => $key,
                        'schedule_id' => $key2
                    ]);
    
                    $user->weekdaySchedules()->save($scheduling);
                }
            }
        }
        
        $success = true;
        $message .= "Tu planificación se ha guardado correctamente";

        $response = array('success' => $success, 'message' => $message);

        return response()->json($response);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WeekdaySchedule  $weekdaySchedule
     * @return \Illuminate\Http\Response
     */
    public function show(WeekdaySchedule $weekdaySchedule)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WeekdaySchedule  $weekdaySchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WeekdaySchedule $weekdaySchedule)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WeekdaySchedule  $weekdaySchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(WeekdaySchedule $weekdaySchedule)
    {
        //
    }
}
