<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pronunciations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pronunciations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('a');
            $table->string('b');
            $table->string('c');
            $table->string('d');
            $table->string('pronunciation_a');
            $table->string('pronunciation_b');
            $table->string('pronunciation_c');
            $table->string('pronunciation_d');
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
        Schema::dropIfExists('pronunciations');
    }
}
