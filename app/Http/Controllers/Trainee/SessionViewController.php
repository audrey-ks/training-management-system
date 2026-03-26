<?php
namespace App\Http\Controllers\Trainee;

use App\Http\Controllers\Controller;
use App\Models\SessionEnrollment;
use App\Models\SessionMaterial;
use App\Models\TrainingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SessionViewController extends Controller
{
    public function index()
    {
        $trainee  = auth()->user();
        $enrolled = $trainee->enrolledSessions()->pluck('training_sessions.id');

        $sessions = TrainingSession::whereIn('status', ['active', 'upcoming', 'completed'])
            ->withCount('materials', 'enrollments')
            ->with('trainer')
            ->latest()->paginate(12);

        return view('trainee.sessions.index', compact('sessions', 'enrolled'));
    }

    public function show(TrainingSession $session)
    {
        $trainee  = auth()->user();
        $enrolled = SessionEnrollment::where('session_id', $session->id)
            ->where('trainee_id', $trainee->id)->first();
        $materials = $session->materials()->approved()->with('uploader')->get();

        return view('trainee.sessions.show', compact('session', 'enrolled', 'materials'));
    }

    public function enroll(Request $request, TrainingSession $session)
    {
        $trainee = auth()->user();

        $already = SessionEnrollment::where('session_id', $session->id)
            ->where('trainee_id', $trainee->id)->exists();

        if ($already) {
            return back()->with('error', 'You are already enrolled in this session.');
        }

        $count = SessionEnrollment::where('session_id', $session->id)->count();
        if ($count >= $session->max_trainees) {
            return back()->with('error', 'This session is full.');
        }

        SessionEnrollment::create([
            'session_id'  => $session->id,
            'trainee_id'  => $trainee->id,
            'status'      => 'enrolled',
            'enrolled_at' => now(),
        ]);

        return back()->with('success', 'Successfully enrolled in the session!');
    }

    public function download(TrainingSession $session, SessionMaterial $material)
    {
        $trainee  = auth()->user();
        $enrolled = SessionEnrollment::where('session_id', $session->id)
            ->where('trainee_id', $trainee->id)->exists();

        if (! $enrolled) {
            abort(403, 'You must be enrolled to download materials.');
        }

        if ($material->status !== 'approved') {
            abort(403, 'This material is not available.');
        }

        if (! Storage::disk('public')->exists($material->file_path)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('public')->download($material->file_path, $material->file_name);
    }
}
