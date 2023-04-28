<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Imports\StudentSheetImport;
use App\Jobs\SendStudentMailJob;
use App\Models\Department;
use App\Models\Role;
use App\Models\Sessions;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create_students');

        return view('students.create', [
            'departments' => Department::all(),
            'sessions' => Sessions::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        $this->authorize('create_students');

        $avatarName = '';
        $rollNumber = '';
        $email = '';
        $password = Hash::make('password'); // generate a random string password

        try {
            if ($request->has('avatar')) {
                $avatar = $request->file('avatar');
                $avatarName = time() . '.' . $avatar->getClientOriginalExtension();

                $avatar->move(public_path('assets/images/avatar/'), $avatarName);
            }

            if ($request->has('roll_number')) {
                $rollNumber = strtolower(trim($request->roll_number));
                $email = $rollNumber . Student::EMAIL_DOMAIN;
            }

            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $email,
                'password' => $password,
                'phone' => $request->phone,
                'lang' => 'en',
                'gender' => $request->gender,
                'avatar' => $avatarName,
                'state' => $request->state,
                'city' => $request->city,
                'country' => $request->country,
            ]);

            $student = Student::create([
                'user_id' => $user->id,
                'department_id' => $request->department_id,
                'session_id' => $request->session_id,
                'roll_number' => $rollNumber,
                'semester' => $request->semester,
                'credit_hours' => $request->credit_hours,
                'quality_points' => $request->quality_points,
                'cgpa' => $request->cgpa,
                'is_alumni' => $request->is_alumni == '1' ? '1' : '0',
            ]);

            $user->assignRole(Role::ROLE_STUDENT);

            DB::commit();

            if ($student) {
                SendStudentMailJob::dispatch($user);

                return redirect()->route('faculty.students.index')
                    ->with('success_message', 'Student created successfully');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()
                ->with('error_message', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $this->authorize('view_students');

        return view('students.show', [
            'student' => $student,
        ]);
    }

    public function searchRollNumber(Request $request)
    {
        $student = Student::whereRaw('LOWER(students.roll_number) = ?', [trim(strtolower($request->roll_number))])
            ->first();


        if (!$student) {
            return response([
                'status' => 404,
                'message' => 'Bad Request'
            ], 404);
        }

        $user = User::find($student->user_id);

        return response([
            'status' => 200,
            'student' => $student,
            'user' => $user
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $this->authorize('update_students');

        return view('students.edit', [
            'student' => $student,
            'departments' => Department::all(),
            'sessions' => Sessions::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $this->authorize('update_students');

        try {
            if ($request->has('avatar')) {

                // delete existing avatar 
                $oldAvatar = public_path('assets/images/avatar/' . $student->user->avatar);
                if (File::exists($oldAvatar)) {
                    File::delete($oldAvatar);
                }

                $avatar = $request->file('avatar');
                $avatarName = 'avatar-' . time() . '.' . $avatar->getClientOriginalExtension();

                $avatar->move(public_path('assets/images/avatar/'), $avatarName);
            } else {
                $avatarName = $student->user->avatar;
            }

            DB::beginTransaction();

            $user = $student->user->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'lang' => 'en',
                'gender' => $request->gender,
                'avatar' => $avatarName,
                'state' => $request->state,
                'city' => $request->city,
                'country' => $request->country,
            ]);

            $student = $student->update([
                'department_id' => $request->department_id,
                'session_id' => $request->session_id,
                'semester' => $request->semester,
                'credit_hours' => $request->credit_hours,
                'quality_points' => $request->quality_points,
                'cgpa' => $request->cgpa,
                'is_alumni' => $request->is_alumni == '1' ? '1' : '0',
            ]);

            DB::commit();

            if ($student && $user) {

                return redirect()->route('faculty.students.index')
                    ->with('success_message', 'Student updated successfully');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()
                ->with('error_message', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $this->authorize('delete_students');

        return back()->with('warning_message', 'Functionality Incomplete, contact the authority');
    }

    public function sheetImportPage()
    {
        return view('students.import');
    }

    public  function sheetImport(Request $request)
    {
        $this->validate($request, [
            'sheet' => 'required|mimes:csv,xls,xlsx'
        ]);

        try {
            Excel::import(new StudentSheetImport, $request->file('sheet'));

            return redirect()->route('faculty.students.index')
                ->with('success_message', 'Sheet successfully imported');
        } catch (\Throwable $th) {
            return back()->with('error_message', $th->getMessage());
        }
    }
}
