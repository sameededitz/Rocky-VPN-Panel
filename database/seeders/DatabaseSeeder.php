<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create one admin user
        User::factory()->admin()->create();
        
        // Create one regular user
        User::factory()->user()->create();

        Plan::factory(3)->create();
    }
}
