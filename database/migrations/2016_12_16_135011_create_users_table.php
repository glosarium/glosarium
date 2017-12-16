<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('username', 50)->unique('UNIQ_8D93D649F85E0677');
			$table->string('email', 100)->unique('UNIQ_8D93D649E7927C74');
			$table->string('image', 250)->nullable();
			$table->enum('type', array('admin','contributor'))->default('contributor');
			$table->text('about', 65535);
			$table->string('headline', 50);
			$table->string('website', 100)->nullable();
			$table->string('twitter', 15)->nullable();
			$table->string('instagram', 30)->nullable();
			$table->string('facebook', 100)->nullable();
			$table->string('password');
			$table->string('remember_token')->nullable();
			$table->boolean('is_active');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
