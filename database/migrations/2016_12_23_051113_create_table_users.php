<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */


    /**
     * status 0观众 1主播(未直播) 21主播(直播中) 3封号 4被禁主播
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
//            默认是不能为空的
            $table->increments('id');
            $table->string('username')->unique()->nullable();
            $table->string('password');
            $table->unsignedSmallInteger('status')->default('0');
            $table->text('desc')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->text('avatar_url')->nullable();
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
        Schema::drop('users');
    }
}
