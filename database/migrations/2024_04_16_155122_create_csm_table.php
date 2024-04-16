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
        Schema::create('csm', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->nullable();
            $table->string('rated_office')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('email_address')->nullable();
            $table->string('name')->nullable();
            $table->string('user_type')->nullable();
            $table->string('transaction_purpose')->nullable();
            $table->string('facilitator')->nullable();
            $table->string('cc1')->nullable();
            $table->string('cc2')->nullable();
            $table->string('cc3')->nullable();
            $table->string('cc3_explanation')->nullable();
            $table->string('q1')->nullable();
            $table->string('a1')->nullable();
            $table->string('q2')->nullable();
            $table->string('a2')->nullable();
            $table->string('q3')->nullable();
            $table->string('a3')->nullable();
            $table->string('q4')->nullable();
            $table->string('a4')->nullable();
            $table->string('q5')->nullable();
            $table->string('a5')->nullable();
            $table->string('q6')->nullable();
            $table->string('a6')->nullable();
            $table->string('q7')->nullable();
            $table->string('a7')->nullable();
            $table->string('q8')->nullable();
            $table->string('a8')->nullable();
            $table->string('comprehensive_type')->nullable();
            $table->string('complaint_message')->nullable();
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
        Schema::dropIfExists('csm');
    }
};
