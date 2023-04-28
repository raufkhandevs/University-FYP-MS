<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panel extends Model
{
    use HasFactory;

    protected $table = 'panels';

    protected $guarded = [];

    /**
     * Get the user associated with the Panel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    protected function department()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    /**
     * Get all of the comments for the Panel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    protected function facultyMembers()
    {
        return $this->hasManyThrough(
            Faculty::class,
            PanelHasFaculty::class,
            'panel_id',
            'id',
            'id',
            'faculty_id',
        );
    }
}
