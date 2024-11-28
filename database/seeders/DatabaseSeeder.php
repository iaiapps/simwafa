<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        // $this->call(TeacherSeeder::class);
        // $this->call(StudentSeeder::class);
        // $this->call(ClusterSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(StageSeeder::class);
        $this->call(KomponenSeeder::class);
    }
}
