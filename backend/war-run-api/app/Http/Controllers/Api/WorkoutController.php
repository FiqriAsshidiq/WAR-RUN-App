<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Workout;
use App\Models\WorkoutTrack;
use App\Services\GeoService; 
use Carbon\Carbon;

class WorkoutController extends Controller
{
    protected GeoService $geoService;

    public function __construct(GeoService $geoService) 
    {
        $this->geoService = $geoService;
    }

    public function start(Request $request)
    {
        $request->validate([
            'start_lat' => 'required|numeric',
            'start_lng' => 'required|numeric',
        ]);

        $workout = Workout::create([
            'user_id' => $request->user()->id,
            'start_time' => Carbon::now(),
            'start_lat' => $request->start_lat,
            'start_lng' => $request->start_lng,
            'is_loop' => false,
        ]);

        return response()->json([
            'message' => 'Workout started',
            'workout_id' => $workout->id
        ]);
    }

    public function end(Request $request, Workout $workout)
    {
        abort_if($workout->user_id !== auth()->id(), 403);

        $request->validate([
            'end_lat' => 'required|numeric',
            'end_lng' => 'required|numeric',
        ]);


        $workout->load('tracks');

        $workout->update([
            'end_time' => now(),
            'end_lat' => $request->end_lat,
            'end_lng' => $request->end_lng,
        ]);

        $totalDistance = 0;
        $maxSpeed = 0;

        $tracks = $workout->tracks;

        for ($i = 1; $i < $tracks->count(); $i++) {
            $distance = $this->geoService->distance(
                $tracks[$i - 1]->lat,
                $tracks[$i - 1]->lng,
                $tracks[$i]->lat,
                $tracks[$i]->lng
            );

            $timeDiff = strtotime($tracks[$i]->recorded_at) - strtotime($tracks[$i - 1]->recorded_at);

            if ($timeDiff > 0) {
                $speed = $distance / $timeDiff;
                $maxSpeed = max($maxSpeed, $speed);
            }

            $totalDistance += $distance;
        }

        $duration = strtotime($workout->end_time) - strtotime($workout->start_time);
        $avgSpeed = $duration > 0 ? $totalDistance / $duration : 0;

        $loopDistance = $this->geoService->distance(
            $workout->start_lat,
            $workout->start_lng,
            $request->end_lat,
            $request->end_lng
        );

        $isLoop = $loopDistance <= 20; 

        $workout->update([
            'total_distance' => round($totalDistance, 2),
            'avg_speed' => round($avgSpeed, 2),
            'max_speed' => round($maxSpeed, 2),
            'is_loop' => $isLoop,
        ]);

        return response()->json([
            'message' => 'Workout ended',
            'total_distance' => $totalDistance,
            'avg_speed' => $avgSpeed,
            'max_speed' => $maxSpeed,
            'is_loop' => $isLoop
        ]);
    }
}
