<?php
use App\Models\ActivityShipment;
use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\Shipment;

class ProductSeeder extends Seeder
{

    public function run()
    {
    	$limit = (int) env('DBSEED_PRODUCTS', 10);
        factory(\App\Models\Product::class, $limit)->create()->each(function($product){
        	// Something for each product
        });
    }

}

