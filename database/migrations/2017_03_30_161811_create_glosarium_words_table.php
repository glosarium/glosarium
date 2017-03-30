<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGlosariumWordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('glosarium_words', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('category_id')->index('IDX_ECFCD69212469DE2');
			$table->integer('user_id')->nullable()->index('IDX_ECFCD692A76ED395');
			$table->string('slug')->unique('UNIQ_ECFCD692989D9B62');
			$table->string('alias')->nullable();
			$table->string('origin');
			$table->string('locale');
			$table->string('lang', 10);
			$table->string('spell')->nullable();
			$table->string('pronounce')->nullable();
			$table->boolean('is_published');
			$table->boolean('is_standard');
			$table->boolean('has_description')->default(1);
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
		Schema::drop('glosarium_words');
	}

}
