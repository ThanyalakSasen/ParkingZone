<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserDefualtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@email.com'],
            [
                'name' => 'admin',
                'password' => Hash::make('admin123456'),
                'is_admin' => true,
            ]
        );

        User::firstOrCreate(
            ['email' => 'user@email.com'],
            [
                'name' => 'user',
                'password' => Hash::make('user123456'),
                'is_admin' => false,
            ]
        );
    }
}
