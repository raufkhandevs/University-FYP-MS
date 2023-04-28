<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProjectAllocation extends Model
{
    use HasFactory;

    protected $table = 'project_allocations';

    protected $guarded = [];

    public function project()
    {
        return $this->hasOne(Project::class, 'id', 'project_id');
    }

    public function supervisor()
    {
        return $this->hasOne(Faculty::class, 'id', 'supervisor_id');
    }

    /**
     * Get the group associated with the ProjectAllocation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function group(): HasOne
    {
        return $this->hasOne(Group::class, 'id', 'group_id');
    }
}
