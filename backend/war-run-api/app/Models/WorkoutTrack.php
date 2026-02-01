<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutTrack extends Model
{
    protected $fillable = ['workout_id','lat','lng','recorded_at'];

    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }
}
