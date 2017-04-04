<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGlosariumFavoritesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('glosarium_favorites', function(Blueprint $table)
		{
			$table->foreign('word_id', 'FK_glosarium_favorites_glosarium_words')->references('id')->on('glosarium_words')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('user_id', 'FK_glosarium_favorites_users')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('glosarium_favorites', function(Blueprint $table)
		{
			$table->dropForeign('FK_glosarium_favorites_glosarium_words');
			$table->dropForeign('FK_glosarium_favorites_users');
		});
	}

}
