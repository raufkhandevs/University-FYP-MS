<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groups';

    protected $guarded = [];

    public function members()
    {
        return $this->hasManyThrough(
            Student::class,
            StudentHasGroup::class,
            'group_id',
            'id',
            'id',
            'student_id'
        );
    }

    public function project()
    {
        return $this->hasOneThrough(
            Project::class,
            ProjectAllocation::class,
            'group_id',
            'id',
            'id',
            'project_id',
        );
    }
}
