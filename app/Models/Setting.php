<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'header_logo',
        'favicon',
        'main_title',
        'contact_no',
        'address',
        'email',
        'copyrights'
    ];
}
