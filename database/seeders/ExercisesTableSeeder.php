<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExercisesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('exercises')->insert([
            [
                'name' => 'Barbell Press',
                'equipment_type_id' => 1, // Barbell
                'instructions' => '1. Lie flat on a bench. 2. Grip the bar slightly wider than shoulder-width. 3. Lower the bar to your chest and press upward.',
                'image_url' => null,
            ],
            [
                'name' => 'Dumbbell Press',
                'equipment_type_id' => 2, // Dumbbell
                'instructions' => '1. Sit or lie back on a bench. 2. Press the dumbbells upward. 3. Lower with control.',
                'image_url' => null,
            ],
            [
                'name' => 'EZ-Bar Curl',
                'equipment_type_id' => 6, // EZ-Bar
                'instructions' => '1. Stand upright holding the EZ-Bar. 2. Curl the bar towards your chest. 3. Lower slowly.',
                'image_url' => null,
            ],
            [
                'name' => 'Single Lat Pulldown',
                'equipment_type_id' => 5, // Cable
                'instructions' => '1. Sit at the machine and grip the handle. 2. Pull the handle to your chest. 3. Release with control.',
                'image_url' => null,
            ],
            [
                'name' => 'Leg Extensions',
                'equipment_type_id' => 7, // Machine
                'instructions' => '1. Sit and place your legs under the pad. 2. Extend your legs fully. 3. Return to start position.',
                'image_url' => null,
            ],
            [
                'name' => 'Squat',
                'equipment_type_id' => 1, // Barbell
                'instructions' => '1. Stand with barbell on your back. 2. Lower into a squat. 3. Drive back up to standing.',
                'image_url' => null,
            ],
            [
                'name' => 'Deadlift',
                'equipment_type_id' => 1, // Barbell
                'instructions' => '1. Stand with feet hip-width apart. 2. Grip the bar and lift. 3. Lower the bar under control.',
                'image_url' => null,
            ],
        ]);
    }
}
