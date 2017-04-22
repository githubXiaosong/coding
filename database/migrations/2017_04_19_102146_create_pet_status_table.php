<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    //unique    default     nullable
    public function up()
    {
        Schema::create('pet_status', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pet_id');
            $table->unsignedInteger('weight');
            $table->timestamps();
            $table->foreign('pet_id')->references('id')->on('pets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pet_status');
    }
}
