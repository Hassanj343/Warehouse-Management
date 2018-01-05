<?php
use App\Models\Customer;
use Illuminate\Database\Seeder;
class CustomerSeeder extends Seeder {

    public function run()
    {
    	$limit = (int) env('DBSEED_CUSTOMERS',10);
		factory(Customer::class,$limit)->make();
        
    }

}
