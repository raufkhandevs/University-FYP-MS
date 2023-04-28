<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionType extends Model
{
    use HasFactory;

    protected $table = 'submission_types';

    protected $guarded = [];

    /**
     * Get all of the submissions for the SubmissionType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function submissions()
    {
        return $this->hasMany(Submission::class, 'submission_type_id', 'id');
    }
}
