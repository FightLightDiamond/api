<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SectionTests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('section_id');
            $table->text('question');
            $table->text('reply1');
            $table->text('reply2');
            $table->text('reply3');
            $table->text('reply4');
            $table->unsignedTinyInteger('answer');
            $table->tinyInteger('is_active');
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by');
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
        Schema::dropIfExists('section_tests');
    }
}
