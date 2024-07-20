<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'remember_token' => null,
                'email_verified_at' => now(),
                'created_at' => now(),
            ],
            [
                'name' => 'Super Admin1',
                'email' => 'superadmin@example.com',
                'password' => bcrypt('password'),
                'role' => 'super_admin',
                'remember_token' => null,
                'email_verified_at' => now(),
                'created_at' => now(),
            ],
            [
                'name' => 'Super Admin2',
                'email' => 'superadmin2@example.com',
                'password' => bcrypt('password'),
                'role' => 'super_admin',
                'remember_token' => null,
                'email_verified_at' => now(),
                'created_at' => now(),
            ],
            [
                'name' => 'Driver',
                'email' => 'driver@example.com',
                'password' => bcrypt('password'),
                'role' => 'driver',
                'remember_token' => null,
                'email_verified_at' => now(),
                'created_at' => now(),
            ]
        ];

        forEach($users as $user) {
            User::create($user);
        }
    }
}
