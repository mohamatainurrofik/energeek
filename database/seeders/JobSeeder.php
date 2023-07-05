<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'name' => 'Frontend Web Developer',
            ],
            [
                'name' => 'Fullstack Web Developer',
            ],
            [
                'name' => 'Quality Control',
            ]
        ];

        foreach ($datas as $key => $data) {
            Job::create($data);
        }
    }
}
