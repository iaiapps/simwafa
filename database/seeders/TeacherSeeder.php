<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Teacher::create([
            'user_id' => '2',
            'name' => 'walas',
        ]);

        Teacher::create([
            'user_id' => '3',
            'name' => 'guru',
        ]);
    }
}
