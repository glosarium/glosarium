<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGlosariumDescriptionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('glosarium_descriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('word_id')->unsigned();
            $table->string('title', 250);
            $table->text('description', 65535);
            $table->string('url', 250);
            $table->integer('vote_up')->default(0);
            $table->integer('vote_down')->default(0);
            $table->timestamps();

            $table->foreign('word_id')
                ->references('id')
                ->on('glosarium_words');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('glosarium_descriptions');
    }

}
