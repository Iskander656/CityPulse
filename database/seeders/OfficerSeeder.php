<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class OfficerSeeder extends Seeder
{
    public function run(): void
    {
        $officerRole = Role::where('name', 'department_officer')
            ->firstOrFail();

        $departments = Department::all();

        if ($departments->isEmpty()) {
            $this->command?->warn('No departments found.');
            return;
        }

        $faker = \Faker\Factory::create();

        foreach ($departments as $department) {
            for ($i = 1; $i <= 10; $i++) {
                $name = $faker->unique()->name();

                User::firstOrCreate(
                    [
                        'email' => sprintf(
                            'officer%02d.department%d@citypulse.test',
                            $i,
                            $department->id
                        ),
                    ],
                    [
                        'name' => $name,
                        'password' => Hash::make('CityPulse123!'),
                        'role_id' => $officerRole->id,
                        'department_id' => $department->id,
                    ]
                );
            }
        }

        $this->command?->info(
            'Officer accounts created successfully: 10 per department.'
        );
    }
}