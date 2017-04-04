<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBlogPostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('blog_posts', function(Blueprint $table)
		{
			$table->foreign('user_id', 'FK_blog_posts_users')->references('id')->on('blog_posts')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('blog_posts', function(Blueprint $table)
		{
			$table->dropForeign('FK_blog_posts_users');
		});
	}

}
