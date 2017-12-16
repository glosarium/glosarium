<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGlosariumWordsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('glosarium_words', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('slug')->unique();
            $table->string('alias')->nullable();
            $table->string('origin');
            $table->string('locale');
            $table->string('lang', 10);
            $table->string('spell')->nullable();
            $table->string('pronounce')->nullable();
            $table->string('source')->nullable();
            $table->string('short_url', 100)->nullable();
            $table->boolean('is_published');
            $table->boolean('is_standard');
            $table->boolean('has_description')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreign('category_id')
                ->references('id')
                ->on('glosarium_categories');
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
