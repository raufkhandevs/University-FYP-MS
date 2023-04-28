<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as ModelsPermission;

class Permission extends ModelsPermission implements \Spatie\Permission\Contracts\Permission
{
    use HasFactory;

    protected $table = 'permissions';

    const operations = ['Create', 'Update', 'Delete', 'View'];

    protected $fillable = [
        'name',
        'title',
        'guard_name',
        'group_name'
    ];

    protected $guard_name = 'web';
}
