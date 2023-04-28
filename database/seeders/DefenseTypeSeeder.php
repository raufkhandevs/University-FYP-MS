<?php

namespace Database\Seeders;

use App\Models\DefenseType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DefenseType::create([
            'name' => DefenseType::DEFENSE_TYPE_PRE,
        ]);

        DefenseType::create([
            'name' => DefenseType::DEFENSE_TYPE_FINAL,
        ]);
    }
}
