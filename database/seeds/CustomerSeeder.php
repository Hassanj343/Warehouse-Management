<?php
use App\Models\Customer;
use Illuminate\Database\Seeder;
class CustomerSeeder extends Seeder {

    public function run()
    {
		if(env('DBSEED_CUSTOMERS',10)){
			for($i = 0 ; $i <env('DBSEED_CUSTOMERS',10) ; $i++){
				$faker = Faker\Factory::create();
				Customer::create(array(
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
