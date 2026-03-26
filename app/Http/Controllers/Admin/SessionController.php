<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrainingSession;
use App\Models\User;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index(Request $request)
    {
        $query = TrainingSession::with('trainer', 'creator');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $query->where('title', 'like', "%{$request->search}%");
        }

        $sessions = $query->latest()->paginate(15);
        return view('admin.sessions.index', compact('sessions'));
    }

    public function create()
    {
        $trainers = User::where('role', 'trainer')->where('is_active', true)->get();
        return view('admin.sessions.create', compact('trainers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'trainer_id'   => 'nullable|exists:users,id',
            'start_date'   => 'required|date',
            'end_date'     => 'required|date|after_or_equal:start_date',
            'location'     => 'nullable|string|max:255',
            'max_trainees' => 'required|integer|min:1',
            'status'       => 'required|in:upcoming,active,completed,cancelled',
        ]);

        $data['created_by'] = auth()->id();
        TrainingSession::create($data);

        return redirect()->route('admin.sessions.index')
            ->with('success', 'Training session created successfully.');
    }

    public function show(TrainingSession $session)
    {
        $session->load('trainer', 'trainees', 'materials.uploader');
        return view('admin.sessions.show', compact('session'));
    }

    public function edit(TrainingSession $session)
    {
        $trainers = User::where('role', 'trainer')->where('is_active', true)->get();
        return view('admin.sessions.edit', compact('session', 'trainers'));
    }

    public function update(Request $request, TrainingSession $session)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'trainer_id'   => 'nullable|exists:users,id',
            'start_date'   => 'required|date',
            'end_date'     => 'required|date|after_or_equal:start_date',
            'location'     => 'nullable|string|max:255',
            'max_trainees' => 'required|integer|min:1',
            'status'       => 'required|in:upcoming,active,completed,cancelled',
        ]);

        $session->update($data);
        return redirect()->route('admin.sessions.index')
            ->with('success', 'Session updated successfully.');
    }

    public function destroy(TrainingSession $session)
    {
        // Remove associated files from storage
        foreach ($session->materials as $material) {
            if (\Storage::disk('public')->exists($material->file_path)) {
                \Storage::disk('public')->delete($material->file_path);
            }
        }
        $session->delete();
        return back()->with('success', 'Session deleted successfully.');
    }

    public function approveMaterial(Request $request, TrainingSession $session, $material)
    {
        $material = $session->materials()->findOrFail($material);
        $material->update([
            'status'      => 'approved',
            'approved_by' => auth()->id(),
        ]);
        return back()->with('success', 'Material approved successfully.');
    }

    public function rejectMaterial(Request $request, TrainingSession $session, $material)
    {
        $material = $session->materials()->findOrFail($material);
        $material->update([
            'status'      => 'rejected',
            'admin_notes' => $request->notes ?? null,
        ]);
        return back()->with('success', 'Material rejected.');
    }
}
