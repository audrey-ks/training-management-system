<?php

namespace App\Http\Controllers\Trainee;

use App\Http\Controllers\Controller;
use App\Models\TrainingSession;
use App\Models\SessionEnrollment;

class DashboardController extends Controller
{
    public function index()
    {
        $trainee = auth()->user();

        $enrollments = SessionEnrollment::where('trainee_id', $trainee->id)
            ->with(['session' => function ($query) {
                $query->withCount('materials');
            }])
            ->latest()
            ->get();

        $enrolledSessions = $enrollments->pluck('session');

        $stats = [
            'enrolled'  => $enrolledSessions->count(),
            'completed' => SessionEnrollment::where('trainee_id', $trainee->id)
                ->where('status', 'completed')
                ->count(),
            'active'    => TrainingSession::whereHas('enrollments', function ($query) use ($trainee) {
                    $query->where('trainee_id', $trainee->id);
                })
                ->where('status', 'active')
                ->count(),
        ];

        return view('trainee.dashboard', compact('enrolledSessions', 'stats'));
    }
}

