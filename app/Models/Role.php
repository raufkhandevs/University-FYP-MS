<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole implements \Spatie\Permission\Contracts\Role
{
    use HasFactory;

    protected $table  = 'roles';

    const ROLE_SUPER_ADMIN = 'Super Admin';
    const ROLE_HOD = 'HOD';
    const ROLE_PROJECT_CONVENER = 'Project Convener';
    const ROLE_FOCAL_PERSON = 'Focal Person';
    const ROLE_SUPERVISOR = 'Supervisor';
    const ROLE_TEACHER = 'Teacher';
    const ROLE_GUEST = 'Guest';
    const ROLE_STUDENT = 'Student';

    protected $fillable = [
        'name',
        'guard_name'
    ];

    protected $guard_name = 'web';
}
