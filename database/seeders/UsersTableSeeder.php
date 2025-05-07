<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $testUsers = [
            [
                'username' => 'coolGirl29',
                'email' => 'coolGirl29@example.com',
                'password' => Hash::make('password'),
                'bio' => 'I am coolGirl29.',
                'profile_picture' => "https://i.pravatar.cc/150?img=5",
            ],
            [
                'username' => 'guy4',
                'email' => 'guy4@example.com',
                'password' => Hash::make('password'),
                'bio' => 'I am guy4.',
                'profile_picture' => "https://i.pravatar.cc/150?img=7",
            ],
            [
                'username' => 'fitRunner22',
                'email' => 'fitRunner22@example.com',
                'password' => Hash::make('password'),
                'bio' => 'I am fitRunner22.',
                'profile_picture' => "https://i.pravatar.cc/150?img=9",
            ],
            [
                'username' => 'gymQueen',
                'email' => 'gymQueen@example.com',
                'password' => Hash::make('password'),
                'bio' => 'I am gymQueen.',
                'profile_picture' => "https://i.pravatar.cc/150?img=11",
            ],
        ];

        foreach ($testUsers as $user) {
            User::create($user);
        }
    }
}