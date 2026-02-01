<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Workout;
use App\Models\WorkoutTrack;

class WorkoutTrackController extends Controller
{
    public function store(Request $request, Workout $workout)
    {
        abort_if($workout->user_id !== auth()->id(), 403);

        $request->validate([
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'recorded_at' => 'required|date',
        ]);

        WorkoutTrack::create([
            'workout_id' => $workout->id,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'recorded_at' => $request->recorded_at,
        ]);

        return response()->json([
            'status' => 'ok'
        ]);
    }
}
