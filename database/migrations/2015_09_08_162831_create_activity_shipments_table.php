<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActivityShipmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activity_shipments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('product_id');
			$table->decimal('sale_price', 11, 0)->nullable();
			$table->integer('quantity')->nullable();
			$table->integer('shipment_id')->nullable();
			$table->timestamps();
			$table->date('date')->nullable();
			$table->time('time')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('activity_shipments');
	}

}
