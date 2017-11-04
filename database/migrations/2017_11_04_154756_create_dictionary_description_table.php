<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDictionaryDescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dictionary_descriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('word_id')->unsigned();
            $table->text('text');
            $table->text('sample');
            $table->string('source')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('word_id')->references('id')->on('dictionary_words');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dictionary_descriptions');
    }
}
