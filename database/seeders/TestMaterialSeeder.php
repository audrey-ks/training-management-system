<?php
namespace Database\Seeders;

use App\Models\SessionEnrollment;
use App\Models\SessionMaterial;
use App\Models\TrainingSession;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TestMaterialSeeder extends Seeder
{
    public function run(): void
    {
        $trainer = User::where('role', 'trainer')->first();
        $trainee = User::where('role', 'trainee')->first();
        $session = TrainingSession::first();

        if (! $session) {
            $this->command->info('No sessions found. Run other seeders first.');
            return;
        }

        // Create test file
        $testFile = 'test-material.pdf';
        $disk     = Storage::disk('public');
        $disk->put('sessions/' . $session->id . '/materials/' . $testFile, 'Test material content for TMS download test');

        SessionMaterial::create([
            'session_id'    => $session->id,
            'uploaded_by'   => $trainer->id,
            'title'         => 'Test Download Material',
            'description'   => 'Test file for download functionality',
            'file_path'     => 'sessions/' . $session->id . '/materials/' . $testFile,
            'file_name'     => 'test-material.pdf',
            'file_type'     => 'application/pdf',
            'file_size'     => 1024,
            'material_type' => 'document',
            'status'        => 'approved', // Pre-approved for testing
        ]);

        // Ensure enrollment
        if (! $trainee || SessionEnrollment::where('trainee_id', $trainee->id)->where('session_id', $session->id)->exists()) {
            $this->command->info('Test data ready.');
            return;
        }

        SessionEnrollment::create([
            'session_id' => $session->id,
            'trainee_id' => $trainee->id,
            'status'     => 'enrolled',
        ]);

        $this->command->info('Test material and enrollment created. Status: approved');
    }
}
