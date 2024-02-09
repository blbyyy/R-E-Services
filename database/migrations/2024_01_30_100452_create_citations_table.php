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
        Schema::create('citations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('researchTitle');
            $table->string('conferenceForum');
            $table->date('date');
            $table->string('venue');
            $table->string('country');
            $table->string('presentor1')->nullable();
            $table->string('presentor2')->nullable();
            $table->string('presentor3')->nullable();
            $table->string('presentor4')->nullable();
            $table->string('presentor5')->nullable();
            $table->string('presentation');
            $table->string('publication');
            $table->string('author1')->nullable();
            $table->string('author2')->nullable();
            $table->string('author3')->nullable();
            $table->string('author4')->nullable();
            $table->string('author5')->nullable();
            $table->string('document')->nullable();
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
        Schema::dropIfExists('citations');
    }
};
