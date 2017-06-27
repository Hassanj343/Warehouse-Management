<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{


    protected $table = 'products';

    protected $fillable = ['name', 'type' , 'quantity', 'price', 'warning', 'barcode', 'location', 'group_id', 'supplier_id', 'image', 'description'];

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
        $this->barcode = sprintf("%s%s",date('dmYhi'),$this->id);
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
