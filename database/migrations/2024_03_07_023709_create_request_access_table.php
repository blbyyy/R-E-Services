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
        Schema::create('student_request_access', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('requestor_id')->unsigned()->nullable();
            $table->foreign('requestor_id')->references('id')->on('users');
            $table->string('requestor_type');
            $table->integer('research_id')->unsigned()->nullable();
            $table->foreign('research_id')->references('id')->on('research_list');
            $table->string('purpose');
            $table->string('status');
            $table->string('start_access_date');
            $table->string('end_access_date')->nullable();
            $table->string('reminder')->nullable();
            $table->timestamps();
        });

        Schema::create('faculty_request_access', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('requestor_id')->unsigned()->nullable();
            $table->foreign('requestor_id')->references('id')->on('users');
            $table->string('requestor_type');
            $table->integer('research_id')->unsigned()->nullable();
            $table->foreign('research_id')->references('id')->on('research_list');
            $table->string('purpose');
            $table->string('status');
            $table->string('start_access_date');
            $table->string('end_access_date')->nullable();
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
        Schema::dropIfExists('request_access');
    }
};
