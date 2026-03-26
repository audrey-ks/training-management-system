<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingSession extends Model
{
    protected $table = 'training_sessions';

    protected $fillable = [
        'title', 'description', 'trainer_id',
        'start_date', 'end_date', 'location',
        'max_trainees', 'status', 'created_by',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function enrollments()
    {
        return $this->hasMany(SessionEnrollment::class, 'session_id');
    }

    public function trainees()
    {
        return $this->belongsToMany(
            User::class,
            'session_enrollments',
            'session_id',
            'trainee_id'
        )->withPivot('status')->withTimestamps();
    }

    public function materials()
    {
        return $this->hasMany(SessionMaterial::class, 'session_id');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'active'    => 'badge-success',
            'upcoming'  => 'badge-info',
            'completed' => 'badge-secondary',
            'cancelled' => 'badge-danger',
            default     => 'badge-light',
        };
    }
}
