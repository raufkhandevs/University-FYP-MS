<?php

namespace App\Imports;

use App\Jobs\SendStudentMailJob;
use App\Models\Department;
use App\Models\Role;
use App\Models\Sessions;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentSheetImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            $student = Student::where('roll_number', $row['roll_number'])->first();
            $department = Department::where('name', 'like', '%' . $row['department'] . '%')->first();
            $session = Sessions::where('session_name', 'like', '%' . $row['session'] . '%')->first();
            $rollNumber = strtolower(trim($row['roll_number']));
            $password = Hash::make('password');

            // only insert new record 
            if (empty($student)) {

                try {

                    DB::beginTransaction();

                    //user 
                    $user = User::create([
                        'name' => $row['name'],
                        'email' => $rollNumber . Student::EMAIL_DOMAIN,
                        'password' => $password,
                        'phone' => $row['phone'],
                        'lang' => 'en',
                        'gender' => $row['gender'],
                        'state' => $row['state'],
                        'city' => $row['city'],
                        'country' => $row['country'],
                    ]);

                    // student details
                    $student = Student::create([
                        'user_id' => $user->id,
                        'department_id' => $department->id,
                        'session_id' => $session->id,
                        'roll_number' => $rollNumber,
                        'semester' => $row['semester'],
                        'credit_hours' => $row['credit_hours'],
                        'quality_points' => $row['quality_points'],
                        'cgpa' => $row['cgpa'],
                        'is_alumni' => $row['is_alumni'],
                    ]);

                    $user->assignRole(Role::ROLE_STUDENT);

                    DB::commit();

                    $student ? SendStudentMailJob::dispatch($user) : '';
                } catch (\Throwable $th) {
                    DB::rollBack();
                }
            }
        }
    }
}
