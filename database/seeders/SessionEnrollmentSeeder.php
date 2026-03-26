<?php
namespace Database\Seeders;

use App\Models\SessionEnrollment;
use Illuminate\Database\Seeder;

class SessionEnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SessionEnrollment::create([
            'session_id' => 1,
            'trainee_id' => 4, // Carol
        ]);

        SessionEnrollment::create([
            'session_id' => 1,
            'trainee_id' => 5, // David
        ]);

        SessionEnrollment::create([
            'session_id' => 2,
            'trainee_id' => 4,
        ]);

        SessionEnrollment::create([
            'session_id' => 3,
            'trainee_id' => 5,
        ]);

        SessionEnrollment::create([
            'session_id' => 3,
            'trainee_id' => 6, // Eve
        ]);
    }
}
