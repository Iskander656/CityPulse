<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        Department::updateOrCreate(
            ['name' => 'Road Maintenance'],
            [
                'description' => 'Responsible for road repairs and maintenance.',
                'contact_email' => 'roads@citypulse.local',
            ]
        );

        Department::updateOrCreate(
            ['name' => 'Public Lighting'],
            [
                'description' => 'Responsible for streetlights and public lighting.',
                'contact_email' => 'lighting@citypulse.local',
            ]
        );

        Department::updateOrCreate(
            ['name' => 'Traffic Management'],
            [
                'description' => 'Responsible for traffic signals and road safety infrastructure.',
                'contact_email' => 'traffic@citypulse.local',
            ]
        );

        Department::updateOrCreate(
            ['name' => 'Waste Management'],
            [
                'description' => 'Responsible for waste collection and disposal infrastructure.',
                'contact_email' => 'waste@citypulse.local',
            ]
        );

        Department::updateOrCreate(
            ['name' => 'Public Infrastructure'],
            [
                'description' => 'Responsible for maintaining public facilities.',
                'contact_email' => 'infrastructure@citypulse.local',
            ]
        );
    }
}