<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Exercises;

class Routines extends Model
{
    protected $primaryKey = 'routine_id';

    protected $fillable = [
        'routine_name',
        'user_id'
    ];

    public function exercises()
    {
        return $this->belongsToMany(Exercises::class, 'exercise_routine', 'routine_id', 'exercise_id')
                    ->withPivot('weight', 'sets', 'reps')->withTimestamps();
    }
}
