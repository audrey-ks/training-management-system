<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name'      => 'Super Admin',
            'email'     => 'admin@tms.com',
            'password'  => Hash::make('password123'),
            'role'      => 'admin',
            'phone'     => '+237600000001',
            'is_active' => 1,
        ]);

        User::create([
            'name'      => 'Alice Trainer',
            'email'     => 'trainer1@tms.com',
            'password'  => Hash::make('password123'),
            'role'      => 'trainer',
            'phone'     => '+237600000002',
            'is_active' => 1,
        ]);

        User::create([
            'name'      => 'Bob Trainer',
            'email'     => 'trainer2@tms.com',
            'password'  => Hash::make('password123'),
            'role'      => 'trainer',
            'phone'     => '+237600000003',
            'is_active' => 1,
        ]);

        User::create([
            'name'      => 'Carol Trainee',
            'email'     => 'trainee1@tms.com',
            'password'  => Hash::make('password123'),
            'role'      => 'trainee',
            'phone'     => '+237600000004',
            'is_active' => 1,
        ]);

        User::create([
            'name'      => 'David Trainee',
            'email'     => 'trainee2@tms.com',
            'password'  => Hash::make('password123'),
            'role'      => 'trainee',
            'phone'     => '+237600000005',
            'is_active' => 1,
        ]);

        User::create([
            'name'      => 'Eve Trainee',
            'email'     => 'trainee3@tms.com',
            'password'  => Hash::make('password123'),
            'role'      => 'trainee',
            'phone'     => '+237600000006',
            'is_active' => 1,
        ]);
    }
}
