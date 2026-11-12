<?php

namespace App\Models;

use App\Models\Report;
use App\Models\ReportActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Override;

class ReportStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_final',
        'sort_order',
    ];

    #[Override]
    protected function casts(): array
    {
        return [
            'is_final' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class, 'status_id');
    }

    public function oldStatusActivities(): HasMany
    {
        return $this->hasMany(ReportActivity::class, 'old_status_id');
    }

    public function newStatusActivities(): HasMany
    {
        return $this->hasMany(ReportActivity::class, 'new_status_id');
    }
}