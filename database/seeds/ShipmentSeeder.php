<?php
use App\Models\ActivityShipment;
use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\Shipment;

class ShipmentSeeder extends Seeder
{

    public function run()
    {

    	$seed_shipments_num = env('DBSEED_SHIPMENTS', 10);
    	$seed_customer_num = env('DBSEED_CUSTOMERS', 10);
    	$seed_products = env('DBSEED_PRODUCTS', 10);

		if($seed_shipments_num){
				$faker = Faker\Factory::create();
			for ($i = 0; $i < $seed_shipments_num; $i++) {
				$shipment = new Shipment;
				$shipment->user_id = 1;
				$shipment->customer_id = rand(1, $seed_customer_num);
				$shipment->date = $faker->dateTimeBetween($startDate = '-2 years', $endDate = '+1 months');
				$shipment->time = $faker->time($format = 'H:i:s', $max = '+24 hours');
				if ($shipment->save()) {
					for ($ii = 0; $ii < rand(5, 10); $ii++) {
						$product = Product::find(rand(1, env('DBSEED_PRODUCTS', 10)));
						ActivityShipment::create(array(
							'product_id' => $product->id,
							'sale_price' => unserialize($product->price)['sale_price'],
							'quantity' => rand(1, 100),
							'date' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = '+6 months'),
							'time' => $faker->time($format = 'H:i:s', $max = '+24 hours'),
							'shipment_id' => $shipment->id
						));
					}
				}
			}
		}
        
    }

}