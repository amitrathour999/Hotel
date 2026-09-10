<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@hotel.com'],
            [
                'name' => 'System Admin',
                'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'customer@hotel.com'],
            [
                'name' => 'John Customer',
                'password' => \Illuminate\Support\Facades\Hash::make('customer123'),
                'role' => 'customer',
            ]
        );

        \App\Models\Room::firstOrCreate(
            ['room_number' => '101'],
            ['price' => 2500, 'type' => 'deluxe', 'status' => 'available', 'description' => 'Luxury Deluxe Suite with Sea View']
        );

        \App\Models\Room::firstOrCreate(
            ['room_number' => '102'],
            ['price' => 4000, 'type' => 'executive', 'status' => 'available', 'description' => 'Executive Suite with King Bed']
        );

        \App\Models\Room::firstOrCreate(
            ['room_number' => '103'],
            ['price' => 1500, 'type' => 'standard', 'status' => 'available', 'description' => 'Cozy Standard Room with Garden View']
        );
    }
}
