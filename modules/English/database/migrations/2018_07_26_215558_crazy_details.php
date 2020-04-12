<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrazyDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crazy_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('crazy_id');
            $table->unsignedInteger('no')->default(0);
            $table->unsignedMediumInteger('time')->default(0);
            $table->string('sentence');
            $table->string('meaning');
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
        Schema::dropIfExists('crazy_details');
    }
}
