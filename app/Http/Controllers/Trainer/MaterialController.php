<?php
namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\SessionMaterial;
use App\Models\TrainingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function index(TrainingSession $session)
    {
        $this->authorizeSession($session);
        $materials = $session->materials()->with('uploader')->latest()->get();
        return view('trainer.sessions.materials', compact('session', 'materials'));
    }

    public function store(Request $request, TrainingSession $session)
    {
        $this->authorizeSession($session);

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'file'        => 'required|file|max:102400', // 100MB max
        ]);

        $file         = $request->file('file');
        $materialType = $this->detectMaterialType($file->getMimeType());

        // Upload to Cloudinary
        try {
            $uploadedFile = cloudinary()->upload($file->getRealPath(), [
                'folder' => "sessions/{$session->id}/materials",
                'resource_type' => 'auto',
                'type'          => 'upload',
                'access_mode'   => 'public',
                'public_id'     => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
            ]);

            $path = $uploadedFile->getSecurePath();

            if (empty($path)) {
                throw new Exception('Cloudinary path empty');
            }
        } catch (Exception $e) {
            Log::error('Cloudinary upload failed: ' . $e->getMessage());
            // Fallback to local storage
            $filename = time() . '_' . $file->getClientOriginalName();
            $path     = $file->storeAs('sessions/' . $session->id . '/materials', $filename, 'public');
        }

        SessionMaterial::create([
            'session_id'    => $session->id,
            'uploaded_by'   => auth()->id(),
            'title'         => $request->title,
            'description'   => $request->description,
            'file_path'     => $path,
            'file_name'     => $file->getClientOriginalName(),
            'file_type'     => $file->getMimeType(),
            'file_size'     => $file->getSize(),
            'material_type' => $materialType,
            'status'        => 'pending',
        ]);

        // Notify admin (placeholder - notification can be added later)
        // App\Models\User::where('role', 'admin')->first()?->notify(new App\Notifications\MaterialPendingApproval(auth()->user(), $session));

        return back()->with('success', 'Material uploaded successfully.');
    }

    public function destroy(TrainingSession $session, SessionMaterial $material)
    {
        $this->authorizeSession($session);

        if ($material->session_id !== $session->id) {
            abort(403);
        }

        if (Storage::disk('public')->exists($material->file_path)) {
            Storage::disk('public')->delete($material->file_path);
        }

        $material->delete();
        return back()->with('success', 'Material deleted successfully.');
    }

    private function authorizeSession(TrainingSession $session): void
    {
        if ($session->trainer_id !== auth()->id()) {
            abort(403, 'You are not assigned to this session.');
        }
    }

    private function detectMaterialType(string $mime): string
    {
        if (str_starts_with($mime, 'image/')) {
            return 'image';
        }

        if (str_starts_with($mime, 'video/')) {
            return 'video';
        }

        if (str_starts_with($mime, 'audio/')) {
            return 'audio';
        }

        if (in_array($mime, ['application/pdf', 'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'text/plain'])) {
            return 'document';
        }

        return 'other';
    }
}
