<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    public const EMAIL_DOMAIN = '@student.usa.edu.pk';

    protected $fillable = [
        'user_id',
        'department_id',
        'session_id',
        'roll_number',
        'semester',
        'credit_hours',
        'quality_points',
        'cgpa',
        'is_alumni',
        'late_status',
        'progress_level',
    ];

    /**
     * Get the user that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    protected function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the department that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    protected function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the sessions associated with the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    protected function sessions(): HasOne
    {
        return $this->hasOne(Sessions::class, 'id', 'session_id');
    }

    /**
     * Get all of the group for the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
    protected function group(): HasOneThrough
    {
        return $this->hasOneThrough(
            Group::class,
            StudentHasGroup::class,
            'student_id',
            'id',
            'id',
            'group_id'
        );
    }

    /**
     * Get the preDefense associated with the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function preDefense(): HasOne
    {
        return $this->hasOne(PreDefense::class,);
    }

    /**
     * Get the finalDefenseGrade associated with the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function finalDefenseGrade(): HasOne
    {
        return $this->hasOne(DefenseGrade::class);
    }

    /**
     * Get the finalGrade associated with the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function finalGrade(): HasOne
    {
        return $this->hasOne(FinalGrade::class);
    }
}
