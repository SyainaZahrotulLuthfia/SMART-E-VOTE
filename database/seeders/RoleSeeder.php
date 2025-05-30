<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// Tambahkan Role Permision dari spatie
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin']); //admin : untuk mengelola ( crud ) data suara
        Role::create(['name' => 'student']); //student : sebagai pemilih
    }
}
