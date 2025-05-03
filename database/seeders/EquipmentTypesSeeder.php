<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipmentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array just to make things easier for me
        $equipmentTypes = [
            'Barbell',
            'Dumbbell',
            'Kettlebell',
            'Yoga Ball',
            'Cable',
            'EZ-Bar',
            'Machine',
            'Assisted',
            'Bodyweight',
            'Other',
        ];

        foreach ($equipmentTypes as $type) {
            DB::table('equipment_types')->insert([
                'name' => $type,
            ]);
        }
    }
}
