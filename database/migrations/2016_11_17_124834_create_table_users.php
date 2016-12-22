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
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique()->nullable();//创建的是默认不能为空的
            $table->string('password');//string默认长度255  varchar
            $table->string('email')->unique()->nullable();
            $table->text('intro')->nullable();
            $table->string('phone')->unique()->nullable(); //+86 13081114886
            $table->text('avatar_url')->nullable();
            $table->timestamps();
            //$table->string('country_code')->default('+86');
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
