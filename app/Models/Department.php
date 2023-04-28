<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    const COMPUTER_SCIENCE_DEPARTMENT = 'Computer Science';

    protected $fillable = [
        'name',
        'about'
    ];
}
