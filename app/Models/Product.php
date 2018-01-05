<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{


    protected $table = 'products';

    protected $fillable = [
        'name', 'barcode', 'description', 'options', 'location', 'purchase_price', 'sale_price',
        'warning_id','supplier_id','group_id','quantity',
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function warning_levels(){
        return $this->belongsTo(WarningLevel::class,'warning_id');
    }

    public function getShipmentActivities()
    {
        return $this->hasMany('ActivityShipment');
    }

    public function getGroup()
    {
        return $this->belongsTo('App\Models\Group','group_id');
    }

    public function getSupplier()
    {
        return $this->belongsTo('App\Models\Supplier','supplier_id');
    }

    public function generateBarcode(){

        $faker = new \Faker\Generator;
        $faker_barcode = new \Faker\Provider\Barcode($faker);

        $this->barcode = $faker_barcode->ean13();
        $this->save();
        return $this->barcode;
    }

    public function getBarcode(){
        $barcode = $this->barcode;
        if(!$barcode){
            $barcode = $this->generateBarcode();
        }
        return $barcode;
    }

}
