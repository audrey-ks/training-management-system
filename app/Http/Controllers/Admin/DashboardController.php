<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TrainingSession;
use App\Models\SessionEnrollment;
use App\Models\SessionMaterial;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users'     => User::count(),
            'total_trainers'  => User::where('role', 'trainer')->count(),
            'total_trainees'  => User::where('role', 'trainee')->count(),
            'total_sessions'  => TrainingSession::count(),
            'active_sessions' => TrainingSession::where('status', 'active')->count(),
            'total_enrolls'   => SessionEnrollment::count(),
            'total_materials' => SessionMaterial::count(),
        ];

        $recentSessions = TrainingSession::with('trainer')
            ->latest()->limit(5)->get();

        $recentUsers = User::latest()->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'recentSessions', 'recentUsers'));
    }
}
