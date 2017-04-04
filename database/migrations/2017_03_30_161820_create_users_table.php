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
			$table->integer('id', true);
			$table->string('name');
			$table->string('username', 50)->unique('UNIQ_8D93D649F85E0677');
			$table->string('email', 100)->unique('UNIQ_8D93D649E7927C74');
			$table->enum('type', array('admin','contributor'))->default('contributor');
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
