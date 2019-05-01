<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCountriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('countries', function(Blueprint $table)
		{
			$table->integer('id')->unsigned()->index();
			$table->string('capital')->nullable();
			$table->string('citizenship')->nullable();
			$table->char('country_code', 3)->default('');
			$table->string('currency')->nullable();
            $table->integer('phone',20);
			$table->string('currency_code')->nullable();
			$table->string('currency_sub_unit')->nullable();
			$table->string('currency_symbol', 3)->nullable();
			$table->integer('currency_decimals')->nullable();
			$table->string('full_name')->nullable();
			$table->char('iso_3166_2', 2)->default('');
			$table->char('iso_3166_3', 3)->default('');
			$table->string('name')->default('');
			$table->char('region_code', 3)->default('');
			$table->char('sub_region_code', 3)->default('');
			$table->boolean('eea')->default(0);
			$table->string('calling_code', 3)->nullable();
			$table->string('flag', 6)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('countries');
	}

}
