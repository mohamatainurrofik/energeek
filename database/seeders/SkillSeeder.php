<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $datas = [
            [
                'name' => 'PHP',
            ],
            [
                'name' => 'PostgreSQL',
            ],
            [
                'name' => 'API (JSON, REST)',
            ],
            [
                'name' => 'Version Control System (Gitlab, Github)',
            ],
        ];

        foreach ($datas as $key => $data) {
            Skill::create($data);
        }
    }
}
