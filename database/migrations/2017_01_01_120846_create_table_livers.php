<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLivers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    /**
     * unique()
     * default()
     * nullable();
     */
    public function up()
    {
        /**
         *    不保留主播的任何信息 先实现"播完即删"
         */
        Schema::create('livers', function (Blueprint $table) {
            /**
             * 暂时先用liver  看不懂那边的
             */
            $table->increments('id');
            $table->unsignedInteger('group_id')->nullable();
            $table->string('title');
            $table->string('nickname')->unique();
            $table->string('head_pic',255)->nullable();
            $table->string('front_cover',255)->nullabel();
            $table->string('location')->nullabel();
            $table->string('push_url',255);
            $table->unsignedTinyInteger('status')->default(0);
            $table->unsignedSmallInteger('like_count')->default(0);
            $table->unsignedInteger('view_count')->default(0);
            $table->unsignedTinyInteger('check_status')->default(0);
            $table->boolean('forbid_flag')->default(0);
            $table->text('desc')->nullable();
            $table->string('play_url',255);
            $table->string('his_play_url',255)->nullable();
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
        Schema::drop('livers');
    }
}
