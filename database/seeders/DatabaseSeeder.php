<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User 1',
            'email' => 'test@example.com',
            'password' => 'password',
            'is_admin' => true
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
            'password' => 'password',
        ]);

        \App\Models\Listing::factory(10)->create([
            'by_user_id' => 1
        ]);

        \App\Models\Listing::factory(10)->create([
            'by_user_id' => 2
        ]);
    }
}
