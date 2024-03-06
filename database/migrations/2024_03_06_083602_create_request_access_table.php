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
        Schema::create('request_access', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('requestor_id')->unsigned()->nullable();
            $table->foreign('requestor_id')->references('id')->on('users');
            $table->string('requestor_type');
            $table->string('research_title');
            $table->string('purpose');
            $table->string('status');
            $table->string('file')->nullable();
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
