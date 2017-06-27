<?php
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{

    public function run()
    {
		if(env('DBSEED_SUPPLIERS', 10)){
			for ($i = 0; $i < env('DBSEED_SUPPLIERS', 10); $i++) {
				$faker = Faker\Factory::create();
				Supplier::create(array(
					'name' => $faker->name,
					'address' => $faker->address,
					'city' => $faker->city,
					'country' => $faker->country,
					'mobile' => $faker->phoneNumber,
					'telephone' => $faker->phoneNumber,
					'email' => $faker->email,
				));
			}
		}
    }

}
