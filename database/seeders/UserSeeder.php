<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\Role;
use App\Models\Sessions;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        // DB::table('model_has_roles')->truncate();
        // DB::table('model_has_permissions')->truncate();

        Schema::enableForeignKeyConstraints();

        $cs_department_id = Department::where('name', 'Computer Science')->pluck('id')->first();
        // creating
        $admin = $this->createSuperAdmin();
        $hod = $this->createHOD($cs_department_id);
        $project_convener = $this->createProjectConvener($cs_department_id);
        $focal_person = $this->createFocalPerson($cs_department_id);
        $supervisor = $this->createSupervisor($cs_department_id);

        // assign roles
        $admin->assignRole(Role::ROLE_SUPER_ADMIN);
        $hod->assignRole(Role::ROLE_HOD);
        $project_convener->assignRole(Role::ROLE_PROJECT_CONVENER);
        $focal_person->assignRole(Role::ROLE_FOCAL_PERSON);
        $supervisor->assignRole(Role::ROLE_SUPERVISOR);

        // assign direct permissions
        // here...
    }

    protected function createSuperAdmin()
    {
        $user = User::create([
            'name' => 'Rauf Khan',
            'email' => 'abdul.rauf@usa.edu.pk',
            'password' => Hash::make('password'),
            'phone' => '+923034192915',
            'lang' => 'en',
            'country' => 'Pakistan',
            'state' => 'Punjab',
            'city' => 'Lahore'
        ]);
        return $user;
    }

    protected function createHOD($dept_id)
    {
        $user = User::create([
            'name' => 'Illyas Butt',
            'email' => 'illyas.butt@usa.edu.pk',
            'password' => Hash::make('password'),
            'phone' => '+999999999999',
            'lang' => 'en',
            'country' => 'Pakistan',
            'state' => 'Punjab',
            'city' => 'Lahore'
        ]);

        Faculty::create([
            'user_id' => $user->id,
            'department_id' => $dept_id,
            'designation' => 'HOD'
        ]);

        return $user;
    }

    protected function createProjectConvener($dept_id)
    {
        $user = User::create([
            'name' => 'Masroor Hussain',
            'email' => 'masroor.hussain@usa.edu.pk',
            'password' => Hash::make('password'),
            'phone' => '+999999999991',
            'lang' => 'en',
            'country' => 'Pakistan',
            'state' => 'Punjab',
            'city' => 'Lahore'
        ]);

        Faculty::create([
            'user_id' => $user->id,
            'department_id' => $dept_id,
            'designation' => 'Project Convener'
        ]);
        return $user;
    }

    protected function createFocalPerson($dept_id)
    {
        $user = User::create([
            'name' => 'Shugufta Riaz',
            'email' => 'shugufta.riaz@usa.edu.pk',
            'password' => Hash::make('password'),
            'phone' => '+999999999992',
            'lang' => 'en',
            'country' => 'Pakistan',
            'state' => 'Punjab',
            'city' => 'Lahore'
        ]);

        Faculty::create([
            'user_id' => $user->id,
            'department_id' => $dept_id,
            'designation' => 'Focal Person'
        ]);
        return $user;
    }

    protected function createSupervisor($dept_id)
    {
        $user = User::create([
            'name' => 'Mubashra Manzoor',
            'email' => 'mubashra.manzoor@usa.edu.pk',
            'password' => Hash::make('password'),
            'phone' => '+999999399993',
            'lang' => 'en',
            'country' => 'Pakistan',
            'state' => 'Punjab',
            'city' => 'Lahore'
        ]);

        Faculty::create([
            'user_id' => $user->id,
            'department_id' => $dept_id,
            'designation' => 'Supervisor'
        ]);
        return $user;
    }
}
