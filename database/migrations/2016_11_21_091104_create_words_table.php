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
            $table->integer('type_id')->unsigned();
            $table->string('slug')->unique();
            $table->string('origin');
            $table->string('glosarium');
            $table->string('spell')->nullable();
            $table->string('pronounce')->nullable();
            $table->enum('status', [
                'drafted',
                'published',
            ])->default('drafted');
            $table->timestamps();

            $table->index(['origin', 'glosarium']);
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
