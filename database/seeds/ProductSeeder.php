<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{

    public function run()
    {

        $types = ['New', 'Refurbished'];
        foreach ($types as $type) {
            $ptype = \App\Models\ProductType::firstOrNew(['type_name' => $type]);
            $ptype->type_name = $type;
            $ptype->save();
        }

        $limit = (int)env('DBSEED_PRODUCTS', 10);
        factory(\App\Models\Product::class, $limit)->create()->each(function ($product) {
            // Something for each product
        });
    }

}

