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
        Schema::create('assessment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date');
            $table->string('name');
            $table->string('address');
            $table->text('age');
            $table->string('status');
            $table->string('sex');
            $table->string('phone');
            $table->string('education_level');
            $table->string('employment')->nullable();
            $table->string('employment_state')->nullable();
            $table->string('training')->nullable();
            $table->string('training1')->nullable();
            $table->string('training2')->nullable();
            $table->string('training3')->nullable();
            $table->string('rank1')->nullable();
            $table->string('rank2')->nullable();
            $table->string('rank3')->nullable();
            $table->string('rank4')->nullable();
            $table->string('rank5')->nullable();
            $table->string('rank6')->nullable();
            $table->string('rank7')->nullable();;
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
        Schema::dropIfExists('assessment');
    }
};
