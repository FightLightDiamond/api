<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillInTheBlanks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fill_in_the_blanks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('question');
            $table->string('a');
            $table->string('b');
            $table->string('c');
            $table->string('d');
            $table->tinyInteger('answer');
            $table->text('reason')->nullable();
            $table->tinyInteger('is_active')->default(0);
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
        Schema::dropIfExists('fill_in_the_blanks');
    }
}
