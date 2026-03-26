<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role',
        'phone', 'profile_photo', 'is_active',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'is_active'         => 'boolean',
    ];

    // ── Roles ────────────────────────────────────────────────
    public function isAdmin(): bool
    {return $this->role === 'admin';}
    public function isTrainer(): bool
    {return $this->role === 'trainer';}
    public function isTrainee(): bool
    {return $this->role === 'trainee';}

    // ── Relations ────────────────────────────────────────────
    public function trainerSessions()
    {
        return $this->hasMany(TrainingSession::class, 'trainer_id');
    }

    public function enrollments()
    {
        return $this->hasMany(SessionEnrollment::class, 'trainee_id');
    }

    public function enrolledSessions()
    {
        return $this->belongsToMany(
            TrainingSession::class,
            'session_enrollments',
            'trainee_id',
            'session_id'
        )->withPivot('status')->withTimestamps();
    }

    public function uploadedMaterials()
    {
        return $this->hasMany(SessionMaterial::class, 'uploaded_by');
    }

    public function getAvatarUrlAttribute(): string
    {
        if ($this->profile_photo) {
            return Storage::url($this->profile_photo);
        }

        $initial = strtoupper(substr($this->name, 0, 1));
        $color   = dechex(crc32($this->email) % 0xFFFFFF);
        $initial = strtoupper(substr($this->name, 0, 1));
        $svg     = '<svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34">
            <rect width="34" height="34" rx="17" fill="#' . $color . '"/>
            <text x="17" y="22" text-anchor="middle" dy=".3em" font-size="14" font-weight="bold" fill="white">' . $initial . '</text>
        </svg>';
        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }
}
