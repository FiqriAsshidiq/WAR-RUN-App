<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TerritoryClaim extends Model
{
    protected $fillable = [
        'territory_id','old_owner_id',
        'new_owner_id','workout_id',
        'claim_time','claim_type'
    ];

    public function territory()
    {
        return $this->belongsTo(Territory::class);
    }
}
