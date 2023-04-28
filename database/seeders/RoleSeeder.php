<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('roles')->truncate();

        Schema::enableForeignKeyConstraints();

        $userAdmin = Role::create(['name' => Role::ROLE_SUPER_ADMIN]);

        Role::create(['name' => Role::ROLE_HOD]);
        Role::create(['name' => Role::ROLE_PROJECT_CONVENER]);
        Role::create(['name' => Role::ROLE_FOCAL_PERSON]);
        Role::create(['name' => Role::ROLE_SUPERVISOR]);
        Role::create(['name' => Role::ROLE_TEACHER]);
        Role::create(['name' => Role::ROLE_STUDENT]);
        Role::create(['name' => Role::ROLE_GUEST]);
    }
}
