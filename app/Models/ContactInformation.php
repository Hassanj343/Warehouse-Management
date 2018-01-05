<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInformation extends Model
{
    protected $table = "contact_information";
    protected $fillable = [
    	'line_1','line2','city','postcode','county',
    	'country','email','mobile_1','mobile_2','telephone',
    	'additional_information',
    ];
    protected $casts = [
    	'additional_information' => 'array'
    ];

    

}
