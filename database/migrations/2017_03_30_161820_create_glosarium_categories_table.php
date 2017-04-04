<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGlosariumCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('glosarium_categories', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('slug')->unique('UNIQ_3CE1A039989D9B62');
			$table->string('name');
			$table->text('description');
			$table->json_array('metadata');
			$table->boolean('is_published');
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
		Schema::drop('glosarium_categories');
	}

}
