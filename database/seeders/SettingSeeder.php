<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('settings')->truncate();

        Schema::enableForeignKeyConstraints();

        $this->createDefaultSettings();
    }

    protected function createDefaultSettings()
    {
        Setting::create([
            'header_logo' => 'logo-main.png',
            'favicon' => 'fav-logo-main.png',
            'main_title' => 'FYP Portal',
            'contact_no' => '+92 311 7111112',
            'address' => '47-Tufail Road, Cantt Lahore',
            'email' => 'admissions@usa.edu.pk',
            'copyrights' => 'Copyright by @ University of South Asia - 2022'
        ]);
    }
}
