<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'ayumirnawati@mail.com'],
            [
                'name' => 'Ayu Mirnawati',
                'password' => Hash::make('password123'),
                'role' => 'jobseeker',
            ]
        );
    }
}
