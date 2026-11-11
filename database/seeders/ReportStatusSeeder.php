<?php

namespace Database\Seeders;

use App\Models\ReportStatus;
use Illuminate\Database\Seeder;

class ReportStatusSeeder extends Seeder
{
    public function run(): void
    {
        ReportStatus::create([
            'name' => 'Submitted',
            'slug' => 'submitted',
            'description' => 'The citizen has submitted the report.',
            'sort_order' => 1,
        ]);

        ReportStatus::create([
            'name' => 'Under Review',
            'slug' => 'under-review',
            'description' => 'The report is being reviewed.',
            'sort_order' => 2,
        ]);

        ReportStatus::create([
            'name' => 'Assigned',
            'slug' => 'assigned',
            'description' => 'The report has been assigned to a department.',
            'sort_order' => 3,
        ]);

        ReportStatus::create([
            'name' => 'In Progress',
            'slug' => 'in-progress',
            'description' => 'The department is working on the reported issue.',
            'sort_order' => 4,
        ]);

        ReportStatus::create([
            'name' => 'Resolved',
            'slug' => 'resolved',
            'description' => 'The reported issue has been resolved.',
            'is_final' => true,
            'sort_order' => 5,
        ]);

        ReportStatus::create([
            'name' => 'Rejected',
            'slug' => 'rejected',
            'description' => 'The report has been rejected.',
            'is_final' => true,
            'sort_order' => 6,
        ]);
    }
}