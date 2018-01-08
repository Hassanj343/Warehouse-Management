<?php namespace App\Models;

use Faker\Generator;
use Faker\Provider\Barcode;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{


    protected $table = 'products';

    protected $fillable = [
        'name', 'barcode', 'description', 'options', 'location', 'purchase_price', 'sale_price',
        'warning_id', 'supplier_id', 'group_id', 'quantity', 'type_id'
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function warning_levels()
    {
        return $this->belongsTo(WarningLevel::class, 'warning_id');
    }

    public function getShipmentActivities()
    {
        return $this->hasMany(ActivityShipment::class);
    }

    public function group()
    {
        return $this->belongsTo(ProductGroup::class, 'group_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function getBarcode()
    {
        $barcode = $this->barcode;
        if (!$barcode) {
            $barcode = $this->generateBarcode();
        }
        return $barcode;
    }

    public function generateBarcode()
    {

        $faker = new Generator;
        $faker_barcode = new Barcode($faker);

        $this->barcode = $faker_barcode->ean13();
        $this->save();
        return $this->barcode;
    }

}
