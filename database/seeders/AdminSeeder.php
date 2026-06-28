<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::truncate();

        User::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
        ]);
    }
}