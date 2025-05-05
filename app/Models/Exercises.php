<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercises extends Model
{
    use HasFactory;

    protected $table = 'exercises';

    protected $primaryKey = 'exercise_id'; // Not just called id so I need to define it

    public $timestamps = false; // So we dont't need to worry about updated_at and created_at

    protected $fillable = [
        'name',
        'equipment_type_id',
        'instructions',
        'image_url'
    ];

    // for the foreign key 'equipment_type_id'
    public function equipmentType()
    {
        return $this->belongsTo(EquipmentTypes::class, 'equipment_type_id');
    }
}
