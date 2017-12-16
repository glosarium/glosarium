<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNewsletterSubscribersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('newsletter_subscribers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('email')->unique();
			$table->string('name', 100)->nullable();
			$table->boolean('is_subscribed');
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
		Schema::drop('newsletter_subscribers');
	}

}
