<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Role;
use App\Models\Sessions;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createStudent();
    }

    public function createStudent()
    {
        $user = User::create([
            'name' => 'Mehwish Khan',
            'email' => 'b-23609@student.usa.edu.pk',
            'password' => Hash::make('password'),
            'phone' => '+999999999993',
            'lang' => 'en',
            'country' => 'Pakistan',
            'state' => 'Punjab',
            'city' => 'Lahore'
        ]);

        $student = Student::create([
            'user_id' => $user->id,
            'department_id' => Department::first()->id,
            'session_id' => Sessions::first()->id,
            'roll_number' => 'b-23609',
            'semester' => 8,
            'credit_hours' => 60,
            'quality_points' => 113,
            'cgpa' => 3.9,
            'is_alumni' => 0
        ]);

        $user->assignRole(Role::ROLE_STUDENT);
    }
}
