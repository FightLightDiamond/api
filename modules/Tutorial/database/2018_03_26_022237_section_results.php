<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SectionResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('section_id');
            $table->mediumInteger('score')->default(0);
            $table->tinyInteger('bonus')->default(0);
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
        Schema::dropIfExists('section_results');
    }
}
