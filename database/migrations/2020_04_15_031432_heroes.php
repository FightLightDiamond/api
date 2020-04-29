<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Heroes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('heroes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nickname');
            $table->string('role');
            $table->string('sayings');
            $table->string('class_id');
            $table->string('image');
            $table->string('element_id');
            $table->unsignedInteger('atk');
            $table->unsignedInteger('def');
            $table->unsignedInteger('hp');
            $table->unsignedInteger('spd');
            $table->string('atk');
            $table->dateTime('publish_time')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('heroes');
    }
}
