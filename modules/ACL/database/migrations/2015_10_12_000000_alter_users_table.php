<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone_number', 15)->unique()->nullable();
            $table->boolean('sex')->default(1);
            $table->dateTime('birthday')->nullable();
            $table->text('address')->nullable();
            $table->text('avatar')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->dateTime('last_login')->nullable();
            $table->dateTime('last_logout')->nullable();
            $table->string('password_temp',60)->nullable();
            $table->string('code',60)->unique()->nullable();
            $table->string('locale')->default('vi');
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('phone_number');
            $table->dropColumn('sex');
            $table->dropColumn('birthday');
            $table->dropColumn('address');
            $table->dropColumn('avatar');
            $table->dropColumn('is_active');
            $table->dropColumn('last_login');
            $table->dropColumn('last_logout');
            $table->dropColumn('password_temp');
            $table->dropColumn('code');
            $table->dropColumn('locale');
        });
    }
}
