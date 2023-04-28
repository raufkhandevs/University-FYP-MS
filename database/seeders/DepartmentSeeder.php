<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('departments')->truncate();
        Schema::enableForeignKeyConstraints();

        $this->createCSDepartment();
        $this->createBBADepartment();
        $this->createFashionDepartment();
        $this->createLawDepartment();
        $this->createHealthDepartment();
    }

    private function createCSDepartment()
    {
        $department = Department::create([
            'name' => 'Computer Science'
        ]);
        return $department;
    }

    private function createBBADepartment()
    {
        $department = Department::create([
            'name' => 'Business Administration'
        ]);
        return $department;
    }

    private function createFashionDepartment()
    {
        $department = Department::create([
            'name' => 'Art & Fashion Design'
        ]);
        return $department;
    }

    private function createHealthDepartment()
    {
        $department = Department::create([
            'name' => 'Health Sciences'
        ]);
        return $department;
    }

    private function createLawDepartment()
    {
        $department = Department::create([
            'name' => 'Law'
        ]);
        return $department;
    }
}
