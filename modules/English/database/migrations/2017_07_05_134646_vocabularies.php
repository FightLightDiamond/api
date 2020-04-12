<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Vocabularies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vocabularies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('word');
            $table->string('type');
            $table->string('pronounce');
            $table->string('meaning');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('is_active')->default(0);
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
        Schema::dropIfExists('vocabularies');
    }
}
