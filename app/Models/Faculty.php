<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $table = 'faculties';

    protected $fillable = [
        'user_id',
        'department_id',
        'designation',
        'digital_sign',
        'working_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    public function panel()
    {
        return $this->hasOneThrough(
            Panel::class,
            PanelHasFaculty::class,
            'faculty_id',
            'id',
            'id',
            'panel_id',
        );
    }
}
