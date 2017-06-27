<?php
use App\Models\ActivityShipment;
use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\Shipment;

class ProductSeeder extends Seeder
{

    public function run()
    {
		if(env('DBSEED_PRODUCTS', 10)){
			for ($i = 0; $i < env('DBSEED_PRODUCTS', 10); $i++) {
				$faker = Faker\Factory::create();

				$product = Product::create(array(
					'name' => $faker->name,
					'quantity' => $faker->numberBetween(10, 9999),
					'price' => serialize(array('purchase_price' => $faker->randomNumber(2), 'sale_price' => $faker->randomNumber(2))),
					'barcode' => $faker->randomNumber($nbDigits = 8) + rand(1,999999999),
					'group_id' => rand(1,env('DBSEED_GROUPS', 10)),
					'supplier_id' => rand(1,env('DBSEED_SUPPLIERS', 10)),
					'description' => $faker->text(),
					'location' => $faker->city,
					'image' => $faker->imageUrl(),
					'warning' => serialize(array('warning_1' => rand(1,35), 'warning_2' => rand(36,75), 'warning_3' => rand(76,125))),
				));
				if ($product->save()) {
					for ($ii = 0; $ii < rand(25, 50); $ii++) {
						ActivityShipment::create(array(
							'product_id' => $product->id,
							'sale_price' => unserialize($product->price)['sale_price'],
							'quantity' => rand(1,100),
							'date' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = '+6 months'),
							'time' => $faker->time($format = 'H:i:s', $max = 'now'),
						));
					}
				}
			}

		}
    }

}

