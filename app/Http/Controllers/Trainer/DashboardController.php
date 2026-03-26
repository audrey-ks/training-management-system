<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\TrainingSession;
use App\Models\SessionMaterial;

class DashboardController extends Controller
{
    public function index()
    {
        $trainer = auth()->user();
        $sessions = TrainingSession::where('trainer_id', $trainer->id)
            ->withCount('materials', 'enrollments')
            ->latest()->get();

        $stats = [
            'total_sessions'   => $sessions->count(),
            'active_sessions'  => $sessions->where('status', 'active')->count(),
            'total_materials'  => SessionMaterial::whereIn('session_id', $sessions->pluck('id'))->count(),
            'total_trainees'   => $sessions->sum('enrollments_count'),
        ];

        return view('trainer.dashboard', compact('sessions', 'stats'));
    }
}
