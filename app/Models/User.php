<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Department;
use App\Models\Report;
use App\Models\ReportActivity;
use App\Models\ReportAssignment;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * role_id is deliberately NOT listed: it must be set by our code,
     * never by request data.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }


    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }


    public function hasRole(string $roleName): bool
    {
        return $this->role?->name === $roleName;
    }

    public function isCitizen(): bool
    {
        return $this->hasRole('citizen');
    }

    public function isAdministrator(): bool
    {
        return $this->hasRole('administrator');
    }

    public function isDepartmentOfficer(): bool
    {
        return $this->hasRole('department_officer');
    }

    public function assignedReports(): HasMany
    {
        return $this->hasMany(Report::class, 'assigned_officer_id');
    }

    public function receivedAssignments(): HasMany
    {
        return $this->hasMany(ReportAssignment::class, 'officer_id');
    }

    public function createdAssignments(): HasMany
    {
        return $this->hasMany(ReportAssignment::class, 'assigned_by');
    }

    public function activities(): HasMany
    {
        return $this->hasMany(ReportActivity::class);
    }
}