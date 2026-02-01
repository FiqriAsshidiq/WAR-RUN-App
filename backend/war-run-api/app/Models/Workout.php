<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    protected $fillable = [
        'user_id','start_time','end_time','total_distance',
        'avg_speed','max_speed','total_steps',
        'start_lat','start_lng','end_lat','end_lng','is_loop'
    ];

    public function tracks()
    {
        return $this->hasMany(WorkoutTrack::class);
    }

    public function territory()
    {
        return $this->hasOne(Territory::class);
    }
}
