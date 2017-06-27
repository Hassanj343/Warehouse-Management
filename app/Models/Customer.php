<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model {

    protected $table = 'customers';
    protected $fillable = ['name','address','city','country','mobile','telephone','email'];

    public function getShipments()
    {
        return $this->hasMany('App\Models\Shipment');
    }

}
