<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBotLineStickersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bot_line_stickers', function(Blueprint $table)
		{
			$table->foreign('line_id', 'FK_bot_line_stickers_bot_line')->references('id')->on('bot_line')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('bot_line_stickers', function(Blueprint $table)
		{
			$table->dropForeign('FK_bot_line_stickers_bot_line');
		});
	}

}
