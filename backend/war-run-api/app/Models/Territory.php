<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Territory extends Model
{
    protected $fillable = [
        'owner_id','workout_id','name',
        'center_lat','center_lng',
        'area_distance','best_time'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }

    public function claims()
    {
        return $this->hasMany(TerritoryClaim::class);
    }
}
