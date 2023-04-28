<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Defense extends Model
{
    use HasFactory;

    protected $table = 'defenses';

    protected $guarded = [];

    /**
     * Get the defenseType that owns the Defense
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function defenseType(): BelongsTo
    {
        return $this->belongsTo(DefenseType::class);
    }

    /**
     * Get the panel associated with the Defense
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function panel(): HasOne
    {
        return $this->hasOne(Panel::class, 'id', 'panel_id');
    }

    /**
     * Get the project associated with the Defense
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function project(): HasOne
    {
        return $this->hasOne(Project::class, 'id', 'panel_id');
    }

    /**
     * Get the preDefense associated with the Defense
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function preDefense(): HasOne
    {
        return $this->hasOne(PreDefense::class);
    }

    /**
     * Get the finalDefenseGrades associated with the Defense
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function finalDefenseGrades(): HasOne
    {
        return $this->hasOne(DefenseGrade::class);
    }

    /**
     * Get all of the finalGradeStudents for the Defense
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function finalGradeStudents()
    {
        return $this->hasMany(DefenseGrade::class);
    }
}
