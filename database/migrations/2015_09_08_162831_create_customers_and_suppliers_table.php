<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomersAndSuppliersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('contact_id')->unsigned();
			$table->timestamps();
		});

		Schema::create('suppliers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('contact_id')->unsigned();
			$table->timestamps();
		});

		Schema::create('contact_information',function(Blueprint $table){

			$table->increments('id');

			$table->longText("line_1");
			$table->longText("line_2")->nullable();
			
			$table->string("city");
			$table->string("postcode");
			$table->string("county");
			$table->string("country");

			$table->longText('additional_information')->nullable();

			$table->string('email')->nullable();
			$table->string('mobile_1')->nullable();
			$table->string('mobile_2')->nullable();
			$table->string('telephone')->nullable();

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
		Schema::dropIfExists('customers');
		Schema::dropIfExists('suppliers');
		Schema::dropIfExists('contact_information');
	}

}
