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
            ['email' => 'jobseeker@jobseeker.com'],
            [
                'name' => 'Jobseeker',
                'password' => Hash::make('password'),
                'role' => 'jobseeker',
            ]
        );
    }
}
