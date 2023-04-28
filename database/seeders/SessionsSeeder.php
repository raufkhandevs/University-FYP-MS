<?php

namespace Database\Seeders;

use App\Models\Sessions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('sessions')->truncate();
        Schema::enableForeignKeyConstraints();

        Sessions::create([
            'session_name' => 'Spring 2019',
            'starting' => '2019-01-01',
            'ending' => '2023-01-01'
        ]);
    }
}
