<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGlosariumDescriptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('glosarium_descriptions', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('word_id')->index('IDX_4B53A8D0E357438D');
			$table->string('title', 250);
			$table->text('description', 65535);
			$table->string('url', 250);
			$table->integer('vote_up')->default(0);
			$table->integer('vote_down')->default(0);
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
		Schema::drop('glosarium_descriptions');
	}

}
