<?php

namespace Database\Seeders;

use App\Models\JobVacancy;
use Illuminate\Database\Seeder;

class JobVacancySeeder extends Seeder
{
    public function run(): void
    {
        $jobs = [
            [
                'title' => 'Frontend Developer',
                'company' => 'Nusantara Tech',
                'location' => 'Jakarta',
                'salary' => 12000000,
                'job_type' => 'Full-time',
                'description' => "Membangun antarmuka web modern dengan Tailwind dan React.\nBerkoordinasi dengan tim product untuk merilis fitur baru.",
            ],
            [
                'title' => 'Backend Engineer',
                'company' => 'Bandung Digital',
                'location' => 'Bandung',
                'salary' => 14000000,
                'job_type' => 'Full-time',
                'description' => "Mengembangkan API Laravel yang andal.\nMengoptimalkan performa query dan caching.",
            ],
            [
                'title' => 'UI/UX Designer',
                'company' => 'Surabaya Kreatif',
                'location' => 'Surabaya',
                'salary' => 9000000,
                'job_type' => 'Part-time',
                'description' => "Mendesain pengalaman pengguna untuk aplikasi mobile dan web.\nMembuat prototipe dan user flow yang jelas.",
            ],
            [
                'title' => 'Data Analyst Intern',
                'company' => 'DataWorks',
                'location' => 'Jakarta',
                'salary' => 0,
                'job_type' => 'Internship',
                'description' => "Membantu membersihkan dan menganalisis data bisnis.\nMenyusun laporan sederhana untuk stakeholder.",
            ],
        ];

        foreach ($jobs as $job) {
            JobVacancy::updateOrCreate(
                ['title' => $job['title'], 'company' => $job['company']],
                $job
            );
        }
    }
}
