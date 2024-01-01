<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // kelas 1
        Grade::create([
            'name_grade' => 'Kelas 1 Abu Bakar',
        ]);
        Grade::create([
            'name_grade' => 'Kelas 1 Umar bin Khatab',
        ]);
        Grade::create([
            'name_grade' => 'Kelas 1 Utsman bin Affan',
        ]);
        Grade::create([
            'name_grade' => 'Kelas 1 Ali bin Abi Thalib',
        ]);

        // kelas 2
        Grade::create([
            'name_grade' => 'Kelas 2 Abu Bakar',
        ]);
        Grade::create([
            'name_grade' => 'Kelas 2 Umar bin Khatab',
        ]);
        Grade::create([
            'name_grade' => 'Kelas 2 Utsman bin Affan',
        ]);
        Grade::create([
            'name_grade' => 'Kelas 2 Ali bin Abi Thalib',
        ]);

        // kelas 3
        Grade::create([
            'name_grade' => 'Kelas 3 Abu Bakar',
        ]);
        Grade::create([
            'name_grade' => 'Kelas 3 Umar bin Khatab',
        ]);
        Grade::create([
            'name_grade' => 'Kelas 3 Utsman bin Affan',
        ]);
        Grade::create([
            'name_grade' => 'Kelas 3 Ali bin Abi Thalib',
        ]);

        // kelas 4
        Grade::create([
            'name_grade' => 'Kelas 4 Abu Bakar',
        ]);
        Grade::create([
            'name_grade' => 'Kelas 4 Umar bin Khatab',
        ]);
        Grade::create([
            'name_grade' => 'Kelas 4 Utsman bin Affan',
        ]);
        Grade::create([
            'name_grade' => 'Kelas 4 Ali bin Abi Thalib',
        ]);

        // kelas 5
        Grade::create([
            'name_grade' => 'Kelas 5 Abu Bakar',
        ]);
        Grade::create([
            'name_grade' => 'Kelas 5 Umar bin Khatab',
        ]);
        Grade::create([
            'name_grade' => 'Kelas 5 Utsman bin Affan',
        ]);
        Grade::create([
            'name_grade' => 'Kelas 5 Ali bin Abi Thalib',
        ]);

        // kelas 6
        Grade::create([
            'name_grade' => 'Kelas 6 Abu Bakar',
        ]);
        Grade::create([
            'name_grade' => 'Kelas 6 Umar bin Khatab',
        ]);
        Grade::create([
            'name_grade' => 'Kelas 6 Utsman bin Affan',
        ]);
        Grade::create([
            'name_grade' => 'Kelas 6 Ali bin Abi Thalib',
        ]);
    }
}
