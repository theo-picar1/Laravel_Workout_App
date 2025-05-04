<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentTypes extends Model
{
    use HasFactory;

    protected $table = 'equipment_types';

    protected $primaryKey = 'equipment_type_id'; // Only need to do this @Oisin if the name is not 'id', not auto-incrementing, not an integer

    public $timestamps = false;

    protected $fillable = ['name'];

    // Relationships
    public function exercises()
    {
        return $this->hasMany(Exercises::class, 'equipment_type_id');
    }
}
