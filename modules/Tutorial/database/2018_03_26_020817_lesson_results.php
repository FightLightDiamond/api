<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LessonResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('created_by')->index();
            $table->unsignedInteger('lesson_id')->index();
            $table->mediumInteger('score')->default(0);
            $table->tinyInteger('bonus')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->unsignedSmallInteger('time')->default(15);
            $table->json('replies')->nullable();
            $table->json('answers')->nullable();
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
        Schema::dropIfExists('lesson_results');
    }
}
