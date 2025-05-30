<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
               //
               $admin = User::create([
                'name' => 'Administrator',
                'email'=> 'admin@gmail.com',
                'password' => Hash::make('123456'),
            ]);
            $admin->assignRole('admin');

               //
               $admin = User::create([
                'name' => 'Student',
                'email'=> 'student@gmail.com',
                'password' => Hash::make('123456'),
            ]);
            $admin->assignRole('student');
    }
}
