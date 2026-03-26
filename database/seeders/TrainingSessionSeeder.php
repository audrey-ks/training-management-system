<?php
namespace Database\Seeders;

use App\Models\TrainingSession;
use Illuminate\Database\Seeder;

class TrainingSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TrainingSession::create([
            'title'        => 'Laravel Web Development',
            'description'  => 'Full course on Laravel framework from basics to advanced REST APIs.',
            'trainer_id'   => 2,
            'start_date'   => '2025-04-01',
            'end_date'     => '2025-04-30',
            'location'     => 'Room A - Douala HQ',
            'max_trainees' => 20,
            'status'       => 'active',
            'created_by'   => 1,
        ]);

        TrainingSession::create([
            'title'        => 'PHP OOP Fundamentals',
            'description'  => 'Object-Oriented Programming with PHP for beginners.',
            'trainer_id'   => 3,
            'start_date'   => '2025-05-01',
            'end_date'     => '2025-05-15',
            'location'     => 'Online - Zoom',
            'max_trainees' => 25,
            'status'       => 'upcoming',
            'created_by'   => 1,
        ]);

        TrainingSession::create([
            'title'        => 'Database Design',
            'description'  => 'MySQL and relational database design principles.',
            'trainer_id'   => 2,
            'start_date'   => '2025-03-01',
            'end_date'     => '2025-03-20',
            'location'     => 'Room B - Douala HQ',
            'max_trainees' => 15,
            'status'       => 'completed',
            'created_by'   => 1,
        ]);
    }
}
