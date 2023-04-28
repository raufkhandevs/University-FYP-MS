<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $table = 'submissions';

    protected $guarded  = [];

    /**
     * Get the submissionType that owns the Submission
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function submissionType()
    {
        return $this->hasOne(SubmissionType::class, 'id', 'submission_type_id');
    }

    /**
     * Get the project associated with the Submission
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function project()
    {
        return $this->hasOne(Project::class, 'id', 'project_id');
    }
}
