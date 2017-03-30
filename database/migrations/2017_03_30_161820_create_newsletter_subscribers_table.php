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
			$table->integer('id', true);
			$table->string('email')->unique('UNIQ_7E8585C8E7927C74');
			$table->string('name')->nullable();
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
