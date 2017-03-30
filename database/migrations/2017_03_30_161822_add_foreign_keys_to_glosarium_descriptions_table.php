<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGlosariumDescriptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('glosarium_descriptions', function(Blueprint $table)
		{
			$table->foreign('word_id', 'FK_description_word')->references('id')->on('glosarium_words')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('glosarium_descriptions', function(Blueprint $table)
		{
			$table->dropForeign('FK_description_word');
		});
	}

}
