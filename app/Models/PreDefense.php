<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreDefense extends Model
{
    use HasFactory;

    const PRE_DEFENSE_STATUS_YES = 'Yes';
    const PRE_DEFENSE_STATUS_NO = 'No';
    const PRE_DEFENSE_STATUS_REPEAT_AGAIN = 'Repeat again';

    protected $table = 'pre_defenses';

    protected $guarded = [];
}
