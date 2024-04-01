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
        Schema::create('research_list', function (Blueprint $table) {
            $table->increments('id');
            $table->text('research_title');
            $table->text('abstract');
            $table->text('department');
            $table->text('course');
            $table->text('faculty_adviser1')->nullable();
            $table->text('faculty_adviser2')->nullable();
            $table->text('faculty_adviser3')->nullable();
            $table->text('faculty_adviser4')->nullable();
            $table->text('researcher1')->nullable();
            $table->text('researcher2')->nullable();
            $table->text('researcher3')->nullable();
            $table->text('researcher4')->nullable();
            $table->text('researcher5')->nullable();
            $table->text('researcher6')->nullable();
            $table->text('time_frame');
            $table->text('date_completion');
            $table->string('research_file');
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
        Schema::dropIfExists('research_list');
    }
};
