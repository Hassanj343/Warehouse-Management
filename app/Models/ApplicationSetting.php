<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationSetting extends Model {

    protected $table = 'application_settings';
    protected $fillable = ['key', 'value'];
    protected $casts = ['value' => 'array'];

}
