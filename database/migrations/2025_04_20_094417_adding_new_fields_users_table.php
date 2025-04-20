<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// THIS MIGRATION WAS MADE TO ADD NEW FIELDS TO THE ALREADY EXISTING USER TABLE

return new class extends Migration
{
    // This function runs when running 'php artisan migrate'. It adds new columns to the table
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->after('id');
            $table->text('profile_picture')->nullable()->after('password');
            $table->text('bio')->nullable()->after('profile_picture');
        });
    }

    // This runs when running 'php artisan migrate:rollback'. Practically an undo button
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'profile_picture', 'bio']);
        });
    }
};
