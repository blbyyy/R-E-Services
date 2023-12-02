<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty', function (Blueprint $table) {
            $table->increments('id');
            $table->text('fname')->nullable()->default('Need to update');
            $table->text('lname')->nullable()->default('Need to update');
            $table->text('mname')->nullable()->default('Need to update');
            $table->text('department')->nullable()->default('Need to update');
            $table->text('position')->nullable()->default('Need to update');
            $table->text('designation')->nullable()->default('Need to update');
            $table->string('email')->unique();
            $table->string('tup_id')->nullable()->default('Need to update');
            $table->text('gender')->nullable()->default('Need to update');
            $table->string('phone')->nullable()->default('Need to update');
            $table->string('address')->nullable()->default('Need to update');
            $table->date('birthdate')->nullable();
            $table->string('avatar')->nullable()->default('avatar.jpg');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('faculty');
    }
};
