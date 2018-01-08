<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = 'product_types';
    protected $fillable = [
        'type_name'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'type_id');
    }
}
