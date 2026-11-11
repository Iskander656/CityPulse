<?php

namespace App\Models;

use App\Enums\ActivityType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportActivity extends Model
{
    use HasFactory;

    public const UPDATED_AT = null;

    protected $fillable = [
        'report_id',
        'user_id',
        'old_status_id',
        'new_status_id',
        'activity_type',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'activity_type' => ActivityType::class,
        ];
    }

    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function oldStatus(): BelongsTo
    {
        return $this->belongsTo(ReportStatus::class, 'old_status_id');
    }

    public function newStatus(): BelongsTo
    {
        return $this->belongsTo(ReportStatus::class, 'new_status_id');
    }
}