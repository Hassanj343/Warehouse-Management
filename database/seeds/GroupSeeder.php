<?php
use App\Models\Group;
use Illuminate\Database\Seeder;
class GroupSeeder extends Seeder {

    public function run()
    {
		if(env('DBSEED_GROUPS',10)){
			for($i = 0 ; $i < env('DBSEED_GROUPS', 10) ; $i++){
				$faker = Faker\Factory::create();
				Group::create(array(
					'name' => $faker->name
				));
			}
		}
    }

}
