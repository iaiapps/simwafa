<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin =
            User::create([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
            ]);
        $admin->assignRole('admin');

        // $walas =
        //     User::create([
        //         'name' => 'walas',
        //         'email' => 'walas@gmail.com',
        //         'password' => Hash::make('password'),
        //     ]);
        // $walas->assignRole('walas');

        // $teacher =
        //     User::create([
        //         'name' => 'teacher',
        //         'email' => 'teacher@gmail.com',
        //         'password' => Hash::make('password'),
        //     ]);
        // $teacher->assignRole('guru');

        // $parent =
        //     User::create([
        //         'name' => 'parent',
        //         'email' => 'parent@gmail.com',
        //         'password' => Hash::make('password'),
        //         // 'role_id' => 1
        //     ]);
        // $parent->assignRole('ortu');
    }
}
