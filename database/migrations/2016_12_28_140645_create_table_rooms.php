<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
//    unique nullable default
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->unique();
            $table->text('url');
            $table->string('title');
            $table->string('desc')->nullable();
            $table->tinyInteger('status')->nullable()->default('1');
            $table->text('cover_addr')->nullable();
            $table->unsignedSmallInteger('category_id');
            $table->unsignedInteger('watcher_num')->nullable()->default(0);
            $table->unsignedInteger('good_num')->nullable()->default(0);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');

            $table->timestamps();
        });
    }


//$table->unique(['is_focus','question_id','user_id']);

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rooms');
    }
}
