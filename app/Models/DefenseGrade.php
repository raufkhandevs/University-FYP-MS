<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefenseGrade extends Model
{
    use HasFactory;

    protected $table = 'defense_grades';

    protected $guarded = [];
}
