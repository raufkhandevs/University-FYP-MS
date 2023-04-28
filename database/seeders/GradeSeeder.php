<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grades = [
            [
                'grade' => 'F',
                'gp' => 0,
                'upper_range_for_100' => 49,
                'lower_range_for_100' => 0,
                'upper_range_for_50' => 24,
                'lower_range_for_50' => 0,
            ],
            [
                'grade' => 'D',
                'gp' => 1,
                'upper_range_for_100' => 54,
                'lower_range_for_100' => 55,
                'upper_range_for_50' => 27,
                'lower_range_for_50' => 25,
            ],
            [
                'grade' => 'D+',
                'gp' => 1.5,
                'upper_range_for_100' => 59,
                'lower_range_for_100' => 55,
                'upper_range_for_50' => 29,
                'lower_range_for_50' => 27,
            ],
            [
                'grade' => 'C',
                'gp' => 2,
                'upper_range_for_100' => 64,
                'lower_range_for_100' => 60,
                'upper_range_for_50' => 32,
                'lower_range_for_50' => 30,
            ],
            [
                'grade' => 'C+',
                'gp' => 2.5,
                'upper_range_for_100' => 69,
                'lower_range_for_100' => 65,
                'upper_range_for_50' => 34,
                'lower_range_for_50' => 32,
            ],
            [
                'grade' => 'B',
                'gp' => 3,
                'upper_range_for_100' => 74,
                'lower_range_for_100' => 70,
                'upper_range_for_50' => 37,
                'lower_range_for_50' => 35,
            ],
            [
                'grade' => 'B+',
                'gp' => 3.5,
                'upper_range_for_100' => 79,
                'lower_range_for_100' => 75,
                'upper_range_for_50' => 39,
                'lower_range_for_50' => 37,
            ],
            [
                'grade' => 'A',
                'gp' => 4,
                'upper_range_for_100' => 84,
                'lower_range_for_100' => 80,
                'upper_range_for_50' => 42,
                'lower_range_for_50' => 40,
            ],
            [
                'grade' => 'A+',
                'gp' => 4,
                'upper_range_for_100' => 100,
                'lower_range_for_100' => 85,
                'upper_range_for_50' => 50,
                'lower_range_for_50' => 42,
            ],
        ];

        foreach ($grades as $grade) {
            Grade::create($grade);
        }
    }
}
