<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\SessionEnrollment;
use App\Models\SessionMaterial;
use App\Models\TrainingSession;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::with('generator')->latest()->paginate(15);
        return view('admin.reports.index', compact('reports'));
    }

    public function create()
    {
        return view('admin.reports.create');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'type'  => 'required|in:users,sessions,enrollments,materials,summary',
            'title' => 'required|string|max:255',
        ]);

        $data = $this->gatherReportData($request->type);

        $report = Report::create([
            'title'        => $request->title,
            'type'         => $request->type,
            'generated_by' => auth()->id(),
            'parameters'   => ['type' => $request->type, 'generated_at' => now()],
        ]);

        return redirect()->route('admin.reports.show', $report)
            ->with('success', 'Report generated successfully.');
    }

    public function show(Report $report)
    {
        $data = $this->gatherReportData($report->type);
        return view('admin.reports.show', compact('report', 'data'));
    }

    public function destroy(Report $report)
    {
        $report->delete();
        return back()->with('success', 'Report deleted successfully.');
    }

    private function gatherReportData(string $type): array
    {
        return match ($type) {
            'users'       => [
                'admins'   => User::where('role', 'admin')->get(),
                'trainers' => User::where('role', 'trainer')->get(),
                'trainees' => User::where('role', 'trainee')->get(),
            ],
            'sessions'    => [
                'sessions' => TrainingSession::with('trainer')->get(),
            ],
            'enrollments' => [
                'enrollments' => SessionEnrollment::with('session', 'trainee')->get(),
            ],
            'materials'   => [
                'materials' => SessionMaterial::with('session', 'uploader')->get(),
            ],
            default       => [ // summary
                'total_users'     => User::count(),
                'total_trainers'  => User::where('role', 'trainer')->count(),
                'total_trainees'  => User::where('role', 'trainee')->count(),
                'total_sessions'  => TrainingSession::count(),
                'active_sessions' => TrainingSession::where('status', 'active')->count(),
                'total_enrolls'   => SessionEnrollment::count(),
                'total_materials' => SessionMaterial::count(),
                'sessions'        => TrainingSession::with('trainer')->withCount('enrollments')->get(),
            ],
        };
    }
}
