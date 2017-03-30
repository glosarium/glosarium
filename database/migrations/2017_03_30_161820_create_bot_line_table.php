<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBotLineTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bot_line', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('token', 250)->index('token');
			$table->string('type', 100);
			$table->string('timestamp', 15);
			$table->string('source', 50);
			$table->string('user', 250);
			$table->boolean('status')->default(0);
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
		Schema::drop('bot_line');
	}

}
