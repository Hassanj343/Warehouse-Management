<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarningLevel extends Model
{
    protected $table = "warning_levels";
    protected $fillable = [
    	'level_1', 'level_2', 'level_3'
    ];
}
