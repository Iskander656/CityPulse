<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'citizen',
        ]);
        Role::create([
            'name' => 'administrator',
        ]);
        Role::create([
            'name' => 'department_officer',
        ]);
    }
}