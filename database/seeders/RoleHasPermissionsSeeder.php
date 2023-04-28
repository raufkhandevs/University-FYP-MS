<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RoleHasPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('role_has_permissions')->truncate();

        Schema::enableForeignKeyConstraints();

        // ---------- roles ---------- //
        // 0 => "Super Admin"
        // 1 => "HOD"
        // 2 => "Project Convener"
        // 3 => "Focal Person"
        // 4 => "Supervisor"
        // 5 => "Teacher"
        // 6 => "Student"
        // 7 => "Guest"

        $admin_role = Role::where('name', Role::ROLE_SUPER_ADMIN)->first();
        $hod_role = Role::where('name', Role::ROLE_HOD)->first();
        $pc_role = Role::where('name', Role::ROLE_PROJECT_CONVENER)->first();
        $focal_person_role = Role::where('name', Role::ROLE_FOCAL_PERSON)->first();
        $supervisor_role = Role::where('name', Role::ROLE_SUPERVISOR)->first();
        $teacher_role = Role::where('name', Role::ROLE_TEACHER)->first();
        $student_role = Role::where('name', Role::ROLE_STUDENT)->first();
        $guest_role = Role::where('name', Role::ROLE_GUEST)->first();

        // give all permissions as admin
        $admin_role->givePermissionTo(Permission::all());
        $hod_role->givePermissionTo(Permission::all());

        // give higher level permissions
        $pc_role->givePermissionTo($this->getPCAndFocalPersonPermissions());
        $focal_person_role->givePermissionTo($this->getPCAndFocalPersonPermissions());

        // give only teacher / supervisor level permissions
        $teacher_role->givePermissionTo($this->getFacultyTeacherPermissions());
        $supervisor_role->givePermissionTo($this->getFacultyTeacherPermissions());
        $guest_role->givePermissionTo($this->getFacultyTeacherPermissions());

        // give student level permissions
        $student_role->givePermissionTo($this->getStudentPermissions());
    }

    public function getPCAndFocalPersonPermissions()
    {
        $permissions =  [
            // add permission name here...
            'view_fypregistrationnumbers',
            'update_fypregistrationnumbers',
            'create_fypregistrationnumbers',
            'delete_fypregistrationnumbers',

            'view_projects',
            'create_projects',
            'update_projects',
            'delete_projects',

            'create_meetups',
            'view_meetups',
            'update_meetups',
            'delete_meetups',

            'create_panels',
            'view_panels',
            'update_panels',
            'delete_panels',

            'view_groups',
            'create_groups',
            'update_groups',
            'delete_groups',

            // 'create_submissions',
            'view_submissions',
            'update_submissions',
            'delete_submissions',

            'view_defenses',
            'create_defenses',
            'update_defenses',
            'delete_defenses',

            'view_finalgrades',
            'create_finalgrades',
            'update_finalgrades',
            'delete_finalgrades',
        ];

        return Permission::whereIn('name', $permissions)->get();
    }

    public function getFacultyTeacherPermissions()
    {
        $permissions = [
            // add permission name here...
            'view_projects',
            'create_projects',
            'update_projects',
            'delete_projects',

            'create_meetups',
            'view_meetups',
            'update_meetups',
            'delete_meetups',

            'view_groups',

            // 'create_submissions',
            'view_submissions',
            'update_submissions',
            'delete_submissions',

            'view_defenses',
            'update_defenses',
            // 'update_defenses',
            // 'delete_defenses',

            'view_finalgrades',
            'create_finalgrades',
            'update_finalgrades',
            'delete_finalgrades',
        ];

        return  Permission::whereIn('name', $permissions)->get();
    }

    public function getStudentPermissions()
    {
        $permissions = [
            // add permission name here...
            'view_fypregistrationnumbers',

            'view_projects',

            'create_meetups',
            'view_meetups',
            'update_meetups',
            'delete_meetups',

            'view_groups',

            'create_submissions',
            'view_submissions',
            'update_submissions',
            'delete_submissions',


            'view_finalgrades'
        ];

        return  Permission::whereIn('name', $permissions)->get();
    }
}
