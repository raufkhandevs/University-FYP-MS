<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $guarded = [];

    /**
     * Get all of the defenses for the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function defenses(): HasMany
    {
        return $this->hasMany(Defense::class, 'project_id', 'id');
    }

    /**
     * Get the preDefense associated with the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function preDefense(): HasOne
    {
        $type = DefenseType::where('name', DefenseType::DEFENSE_TYPE_PRE)->first();
        return $this->hasOne(Defense::class, 'project_id', 'id')->where('defense_type_id', $type->id);
    }

    /**
     * Get the finalDefense associated with the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function finalDefense(): HasOne
    {
        $type = DefenseType::where('name', DefenseType::DEFENSE_TYPE_FINAL)->first();
        return $this->hasOne(Defense::class, 'project_id', 'id')->where('defense_type_id', $type->id);
    }
}
