<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrazyCourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crazy_courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 128);
            $table->string('img')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('is_active')->default(0);
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
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
        Schema::table('crazy_courses', function (Blueprint $table) {
            //
        });
    }
}
