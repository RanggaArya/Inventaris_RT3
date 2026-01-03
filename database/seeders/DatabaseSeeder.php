<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Data users yang akan diinput
        $users = [
            [
                'name' => 'Super Administrator',
                'email' => 'superadmin@example.com',
                'role' => 'super-admin',
                'jabatan' => 'Head of IT',
                'unit' => 'SIRS',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'Admin Manager',
                'email' => 'admin@example.com',
                'role' => 'admin',
                'jabatan' => 'Supervisor',
                'unit' => 'Human Resources',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@example.com',
                'role' => 'user',
                'jabatan' => 'Staff',
                'unit' => 'Operational',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('123456'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
