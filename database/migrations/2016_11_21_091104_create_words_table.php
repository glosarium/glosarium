<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('words', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->string('slug')->unique();
            $table->string('lang', 4)->default('en');
            $table->string('foreign');
            $table->string('locale');
            $table->string('spell')->nullable();
            $table->string('pronounce')->nullable();
            $table->enum('status', [
                'drafted',
                'published',
            ])->default('drafted');
            $table->boolean('is_standard')->default(true);
            $table->timestamps();

            $table->index(['foreign', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('words');
    }
}
