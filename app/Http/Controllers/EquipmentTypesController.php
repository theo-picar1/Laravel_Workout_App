<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EquipmentTypes;

class EquipmentTypesController extends Controller
{
    // To get all exercises from the database to be able to display them
    public function index()
    {
        $equipment_types = EquipmentTypes::all();

        // It will be used in exercises.blade.php
        return view('pages.exercises', compact('equipment_types'));
    }
}
