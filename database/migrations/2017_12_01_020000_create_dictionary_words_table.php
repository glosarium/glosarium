<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDictionaryWordsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dictionary_words', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('group_id')->unsigned();
            $table->string('slug', 100)->unique();
            $table->string('lang', 10);
            $table->string('word', 100)->unique();
            $table->string('pronounciation', 100);
            $table->string('source', 20);
            $table->string('short_url', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreign('group_id')
                ->references('id')
                ->on('dictionary_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dictionary_words');
    }

}
