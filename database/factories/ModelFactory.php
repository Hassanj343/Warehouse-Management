<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/*Product Factory*/
$factory->define(\App\Models\Product::class, function (Faker\Generator $faker) {

    static $group_id;
    static $supplier_id;
    static $warning_id;

    $barcode = new Faker\Provider\Barcode($faker);
    $purchase_price = $faker->randomFloat(2, 0, 1000);
    $product_type = \App\Models\ProductType::inRandomOrder()->limit(1)->get()->first();
    return [
        'name' => $faker->name,
        'barcode' => $barcode->ean13(),
        'description' => $faker->text(),
        'purchase_price' => $purchase_price,
        'sale_price' => $faker->randomFloat(2, $purchase_price, ($purchase_price * 2)),
        'group_id' => $group_id ?: factory(App\Models\ProductGroup::class)->create()->id,
        'supplier_id' => $supplier_id ?: factory(App\Models\Supplier::class)->create()->id,
        'warning_id' => $warning_id ?: factory(App\Models\WarningLevel::class)->create()->id, // todo: create warning factory
        'location' => $faker->city,
        'quantity' => $faker->randomNumber(),
        'type_id' => $product_type->id
    ];
});
// Warning Levels
$factory->define(App\Models\WarningLevel::class, function (Faker\Generator $faker) {

    return [
        'level_1' => $faker->numberBetween(5, 15),
        'level_2' => $faker->numberBetween(20, 35),
        'level_3' => $faker->numberBetween(40, 55),
    ];

});

// Product Group
$factory->define(App\Models\ProductGroup::class, function (Faker\Generator $faker) {
    static $name;
    return [
        'name' => $name ?: $faker->name,
    ];
});
// Product Supplier
$factory->define(App\Models\Supplier::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'contact_id' => factory(App\Models\ContactInformation::class)->create()->id,
    ];
});
// Customer 
$factory->define(App\Models\Customer::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'contact_id' => factory(App\Models\ContactInformation::class)->create()->id,
    ];
});

// Contact Inforamtion
$factory->define(App\Models\ContactInformation::class, function (Faker\Generator $faker) {

    return [
        'line_1' => $faker->streetAddress,
        'city' => $faker->city,
        'postcode' => $faker->postcode,
        'county' => $faker->state,
        'country' => $faker->country,
        'email' => $faker->email,
        'mobile_1' => $faker->phoneNumber
    ];

});