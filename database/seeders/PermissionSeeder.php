<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('permissions')->truncate();

        Schema::enableForeignKeyConstraints();

        $models = $this->getModelNames();

        // add custom permissions here...
        $customPermissions = [
            'UsersManagement',
            'SuperAdmin'
            // 'EnrollStudents'
        ];

        $models = array_merge($models, $customPermissions);

        // remove the pivot models
        foreach ($models as $key => $model) {
            $model_title =  preg_replace('/(?<!^)[A-Z]/', ' $0', $model);
            $lower_model_name = strtolower($model_title);
            $needle = ' has ';
            if (str_contains($lower_model_name, $needle)) {
                unset($models[$key]);
            }
        }

        $actions = ['create', 'update', 'delete', 'view'];

        $allPermissions = [];
        foreach ($models as $model) {
            foreach ($actions as $action) {
                $allPermissions[] = [
                    'name' => $action . '_' . Str::plural(strtolower($model)),
                    'title' => ucwords($action) . ' ' . ucwords(preg_replace('/(?<!^)[A-Z]/', ' $0', $model)),
                    'guard_name' => 'web',
                    'group_name' => strtolower($model),
                    'created_at' => now()->toDateTimeString(),
                    'updated_at' => now()->toDateTimeString()
                ];
            }
        }

        $permissions = Permission::insert($allPermissions);
    }

    protected function getModelNames()
    {
        $modelNames = [];

        foreach ($this->getModelPlugins() as $model) {
            $modelNames[] = basename($model, '.php');
        }

        return $modelNames;
    }

    protected function getModelPlugins()
    {
        $models = [];

        foreach (glob(base_path('app/Models/*.php')) as $model) {
            $models[] = $model;
        }

        return $models;
    }
}
