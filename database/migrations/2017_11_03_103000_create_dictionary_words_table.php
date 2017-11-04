<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->integer('user_id')->nullable()->default(null);
            $table->integer('group_id')->unsigned();
            $table->string('slug', 100)->unique();
            $table->string('lang', 10);
            $table->string('word', 100)->unique();
            $table->string('pronounciation', 100);
            $table->string('source', 20);
            $table->string('short_url', 100)->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('group_id')->references('id')->on('dictionary_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dictionary_words');
    }
}
