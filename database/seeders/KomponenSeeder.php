<?php

namespace Database\Seeders;

use App\Models\Komponen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KomponenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Komponen::create([
            'name_komp' => 'Tajwid',
        ]);
        Komponen::create([
            'name_komp' => 'Fasohah',
        ]);
        Komponen::create([
            'name_komp' => 'Kelancaran',
        ]);
        Komponen::create([
            'name_komp' => 'STS',
        ]);
        Komponen::create([
            'name_komp' => 'SAS',
        ]);
    }
}
