<?php

namespace Database\Seeders;

use App\Models\Stage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stage::create([
            'name_stage' => 'Jilid 1',
        ]);
        Stage::create([
            'name_stage' => 'Jilid 2',
        ]);
        Stage::create([
            'name_stage' => 'Jilid 3',
        ]);
        Stage::create([
            'name_stage' => 'Jilid 4',
        ]);
        Stage::create([
            'name_stage' => 'Jilid 5',
        ]);
        Stage::create([
            'name_stage' => 'Tartil',
        ]);
        Stage::create([
            'name_stage' => 'Tajwid',
        ]);
        Stage::create([
            'name_stage' => 'Pra Munaqosyah',
        ]);
    }
}
