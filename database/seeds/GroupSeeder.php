<?php
use App\Models\Group;
use Illuminate\Database\Seeder;
class GroupSeeder extends Seeder {

    public function run()
    {
		factory(App\Models\ProductGroup::class,env('DBSEED_GROUPS',10));
    }

}
