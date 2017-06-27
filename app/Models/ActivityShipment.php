<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityShipment extends Model {
    protected $fillable = ['product_id','sale_price','quantity','shipment_id','date','time'];

    public function getProduct()
    {
        return $this->belongsTo('App\Models\Product','product_id');
    }
}
