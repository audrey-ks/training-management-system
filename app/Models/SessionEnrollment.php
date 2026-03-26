<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionEnrollment extends Model
{
    protected $table = 'session_enrollments';

    protected $fillable = ['session_id', 'trainee_id', 'status', 'enrolled_at'];

    public function session()
    {
        return $this->belongsTo(TrainingSession::class, 'session_id');
    }

    public function trainee()
    {
        return $this->belongsTo(User::class, 'trainee_id');
    }
}
