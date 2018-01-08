<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('barcode')->nullable()->unique();

            $table->longText('description')->nullable();
            $table->longText('options')->nullable();
            $table->longText('location')->nullable();

            $table->decimal('purchase_price', 10, 2)->nullable();
            $table->decimal('sale_price', 10, 2);

            $table->integer('warning_id')->unsigned();
            $table->integer('supplier_id')->nullable();
            $table->integer('group_id')->nullable();
            $table->integer('type_id');

            $table->integer('quantity')->default(0);

            $table->timestamps();
        });

        Schema::create('product_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('warning_levels', function (Blueprint $table) {

            $table->increments('id');
            $table->integer("level_1")->default(0);
            $table->integer("level_2")->default(0);
            $table->integer("level_3")->default(0);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('warning_levels');
        Schema::dropIfExists('product_groups');
    }

}
