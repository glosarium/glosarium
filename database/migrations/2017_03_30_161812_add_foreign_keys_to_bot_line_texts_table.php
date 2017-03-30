<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBotLineTextsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bot_line_texts', function(Blueprint $table)
		{
			$table->foreign('line_id', 'FK_bot_line_texts_bot_line')->references('id')->on('bot_line')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('bot_line_texts', function(Blueprint $table)
		{
			$table->dropForeign('FK_bot_line_texts_bot_line');
		});
	}

}
