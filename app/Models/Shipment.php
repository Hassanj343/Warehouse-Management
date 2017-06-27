<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $table = 'shipments';
    protected $fillable = ['customer_id', 'user_id','date','time'];

    public static function create(array $args)
    {
        $datetime = array(
            'date' => array_key_exists('date',$args) ? $args['date'] : date('Y-m-d'),
            'time' => array_key_exists('time',$args) ? $args['time'] : date('H:i:s'),
        );
        (array) $arr = array_merge($args,$datetime);
        return parent::create($arr);
    }

    public function getShipmentCount()
    {
        return $this->hasMany('App\Models\ActivityShipment')->count();
    }

    public function getCustomer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

    public function getProductActivity()
    {
        return $this->hasMany('App\Models\ActivityShipment', 'shipment_id');
    }

}
