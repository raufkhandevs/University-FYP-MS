<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DefenseType extends Model
{
    use HasFactory;

    const DEFENSE_TYPE_PRE = 'Pre Defense';
    const DEFENSE_TYPE_FINAL = 'Final Defense';

    protected $table = 'defense_types';

    protected $guarded = [];

    /**
     * Get all of the defense for the DefenseType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function defenses(): HasMany
    {
        return $this->hasMany(Defense::class, 'defense_type_id', 'id');
    }
}
