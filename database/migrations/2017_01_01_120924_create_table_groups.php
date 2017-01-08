<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

//    nullable default unique
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->unsignedInteger('group_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('liver_id');
            $table->string('nickname')->nullable();
            $table->string('head_pic',255)->nullable();
            $table->primary(['group_id','user_id','liver_id']);
            $table->foreign('liver_id')->references('id')->on('livers');
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
        Schema::drop('groups');
    }
}
