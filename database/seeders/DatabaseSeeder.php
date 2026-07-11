<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat akun Admin
        User::updateOrCreate(

            [
                'email' => 'admin@gmail.com',
            ],

            [
                'name' => 'Administrator',

                'role' => 'admin',

                'password' => Hash::make('password'),
            ]

        );

        // Menjalankan Product Seeder
        $this->call([
            ProductSeeder::class,
        ]);
    }
}