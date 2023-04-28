<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FypRegistrationNumber extends Model
{
    use HasFactory;

    protected $table = 'fyp_registration_numbers';

    protected $guarded = [];

    protected $dates = [
        'registration_date'
    ];

    public function student()
    {
        return $this->hasOne(Student::class, 'id', 'student_id');
    }

    public function approvedBy()
    {
        return $this->hasOne(User::class, 'id', 'approved_by');
    }

    public function rejectedBy()
    {
        return $this->hasOne(User::class, 'id', 'rejected_by');
    }
}
