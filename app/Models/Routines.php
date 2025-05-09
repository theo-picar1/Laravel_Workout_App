<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Exercises;

class Routines extends Model
{
    use HasFactory;

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}