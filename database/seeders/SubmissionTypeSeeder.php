<?php

namespace Database\Seeders;

use App\Models\SubmissionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubmissionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubmissionType::create([
            'name' => 'Pre Proposal Document',
        ]);

        SubmissionType::create([
            'name' => 'Chapter 1',
        ]);

        SubmissionType::create([
            'name' => 'Chapter 2',
        ]);

        SubmissionType::create([
            'name' => 'Chapter 3',
        ]);

        SubmissionType::create([
            'name' => 'Final Proposal Document',
        ]);
    }
}
