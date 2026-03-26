<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionMaterial extends Model
{
    protected $table = 'session_materials';

    protected $fillable = [
        'session_id', 'uploaded_by', 'title', 'description',
        'file_path', 'file_name', 'file_type', 'file_size', 'material_type', 'status', 'approved_by', 'admin_notes',
    ];

    public function session()
    {
        return $this->belongsTo(TrainingSession::class, 'session_id');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function getFileSizeHumanAttribute(): string
    {
        $bytes = $this->file_size;
        if ($bytes < 1024) {
            return $bytes . ' B';
        }

        if ($bytes < 1048576) {
            return round($bytes / 1024, 1) . ' KB';
        }

        if ($bytes < 1073741824) {
            return round($bytes / 1048576, 1) . ' MB';
        }

        return round($bytes / 1073741824, 1) . ' GB';
    }

    public function getMaterialIconAttribute(): string
    {
        return match ($this->material_type) {
            'image'    => 'fa-file-image',
            'video'    => 'fa-file-video',
            'audio'    => 'fa-file-audio',
            'document' => 'fa-file-pdf',
            default    => 'fa-file',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending'  => 'Pending Review',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
            default    => 'Unknown',
        };
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'pending'  => 'warning',
            'approved' => 'success',
            'rejected' => 'danger',
            default    => 'secondary',
        };
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}
