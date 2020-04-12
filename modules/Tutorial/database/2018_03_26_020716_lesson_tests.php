<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LessonTests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('lesson_id')->index();
            $table->text('question');
            $table->string('reply1');
            $table->string('reply2');
            $table->string('reply3');
            $table->string('reply4');
            $table->unsignedTinyInteger('answer');
            $table->unsignedSmallInteger('time')->default(15);
            $table->tinyInteger('is_active');
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
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
        Schema::dropIfExists('lesson_tests');
    }
}
