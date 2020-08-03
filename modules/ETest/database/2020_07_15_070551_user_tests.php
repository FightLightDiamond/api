<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserTests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('test_id');
            $table->json('histories');
            $table->json('replies');
            $table->json('answers');
            $table->unsignedTinyInteger('score');
            $table->unsignedTinyInteger('status');
            $table->unsignedSmallInteger('time')->default(15);
            $table->tinyInteger('time_bonus')->default(0);
            $table->dateTime('start_date');
            $table->text('note');
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
        Schema::dropIfExists('user_tests');
    }
}
