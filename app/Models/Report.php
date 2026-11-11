<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Department;
use App\Models\ReportActivity;
use App\Models\ReportAssignment;
use App\Models\ReportImage;
use App\Models\ReportStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'status_id',
        'assigned_department_id',
        'assigned_officer_id',
        'title',
        'description',
        'latitude',
        'longitude',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function status()
    {
        return $this->belongsTo(ReportStatus::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'assigned_department_id');
    }

    public function assignedOfficer()
    {
        return $this->belongsTo(User::class, 'assigned_officer_id');
    }

    public function images()
    {
        return $this->hasMany(ReportImage::class);
    }

    public function assignments()
    {
        return $this->hasMany(ReportAssignment::class);
    }

    public function activities() 
    {
        return $this->hasMany(ReportActivity::class);
    }
}