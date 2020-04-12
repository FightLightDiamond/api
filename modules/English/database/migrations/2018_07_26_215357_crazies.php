<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Crazies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crazies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('crazy_course_id')->nullable();
            $table->string('name');
            $table->string('img')->nullable();
            $table->text('description')->nullable();
            $table->string('audio');
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
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
        Schema::dropIfExists('crazies');
    }
}
