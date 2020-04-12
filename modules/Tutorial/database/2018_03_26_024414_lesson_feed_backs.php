<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LessonFeedBacks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_feed_backs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('lesson_id');
            $table->string('title');
            $table->text('content');
            $table->unsignedInteger('create_by')->nullable();
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
        Schema::dropIfExists('lesson_feedbacks');
    }
}
