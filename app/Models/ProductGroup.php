<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ProductGroup extends Model {

    protected $table = 'product_groups';
    protected $fillable = ['name'];

    public function listProducts(){
        return $this->hasMany('App\Models\Product');
    }
    public function countProducts(){
        return $this->hasMany('App\Models\Product')->count();
    }


}
