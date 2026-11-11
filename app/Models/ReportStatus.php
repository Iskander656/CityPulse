<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
}