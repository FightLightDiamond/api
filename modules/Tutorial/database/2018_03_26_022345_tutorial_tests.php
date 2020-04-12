<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TutorialTests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutorial_tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('tutorial_id');
            $table->text('question');
            $table->text('reply1');
            $table->text('reply2');
            $table->text('reply3');
            $table->text('reply4');
            $table->unsignedTinyInteger('answer');
            $table->tinyInteger('is_active');
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
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
        Schema::dropIfExists('tutorial_tests');
    }
}
