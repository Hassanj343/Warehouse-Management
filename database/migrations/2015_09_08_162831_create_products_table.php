<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('quantity')->nullable()->default(0);
			$table->string('price')->nullable();
			$table->string('barcode')->nullable()->unique();
			$table->integer('group_id')->nullable();
			$table->integer('supplier_id')->nullable();
			$table->string('warning')->nullable();
			$table->string('image')->nullable();
			$table->text('description', 65535)->nullable();
			$table->string('location')->nullable();
			$table->string('type')->default("new");
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
		Schema::drop('products');
	}

}
