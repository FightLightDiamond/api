<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LessonComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('lesson_id');
            $table->text('content');
            $table->unsignedInteger('created_by')->nullable();
            $table->tinyInteger('is_active');
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
        Schema::dropIfExists('lesson_comments');
    }
}
