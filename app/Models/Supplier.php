<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model {

    protected $table = 'suppliers';
    protected $fillable = ['name','address','city','country','mobile','telephone','email'];

    public function getProducts()
    {
        return $this->hasMany('App\Models\Product');
    }

}
