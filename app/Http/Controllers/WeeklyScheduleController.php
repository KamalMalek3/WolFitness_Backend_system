<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeeklySchedule;


class WeeklyScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = WeeklySchedule::all();
        return response()->json($schedules);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'schedule_data' => 'required|string',
        ]);

        $schedule = WeeklySchedule::create($validatedData);

        return response()->json($schedule, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $schedule = WeeklySchedule::find($id);

        if (!$schedule) {
            return response()->json(['message' => 'Weekly schedule not found'], 404);
        }

        return response()->json($schedule);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $schedule = WeeklySchedule::find($id);

        if (!$schedule) {
            return response()->json(['message' => 'Weekly schedule not found'], 404);
        }

        $validatedData = $request->validate([
            'schedule_data' => 'sometimes|required|string',
        ]);

        $schedule->update($validatedData);

        return response()->json($schedule);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $schedule = WeeklySchedule::find($id);

        if (!$schedule) {
            return response()->json(['message' => 'Weekly schedule not found'], 404);
        }

        $schedule->delete();

        return response()->json(['message' => 'Weekly schedule deleted successfully']);
    }
    
}
