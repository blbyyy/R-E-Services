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
        Schema::create('customer_satisfaction_survey', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('rated_department');
            $table->text('transaction_purpose');
            $table->string('date');
            $table->string('time');
            $table->string('facilitator');
            $table->string('name')->nullable();
            $table->string('email_address');
            $table->string('phone');
            $table->string('address');
            $table->string('company');
            $table->string('customer_feedback');
            $table->string('customer_remarks');
            $table->string('q1')->default('How would you rate your OVERALL SATISFACTION with the quality of our service delivery?');
            $table->string('a1');
            $table->string('q2')->default('How satisfied were you in the RESPONSE TIME to your transaction given by our office?');
            $table->string('a2');
            $table->string('q3')->default('How satisfied were you with the OUTCOME of the service provider?');
            $table->string('a3');
            $table->string('q4')->default('How satisfied were you with our provision of INFORMATION on the service?');
            $table->string('a4');
            $table->string('q5')->default('How satisfied were you with our COMPETENCE or skill in service delivery?');
            $table->string('a5');
            $table->string('q6')->default('How satisfied were you with our COURTESY, friendliness, politeness, fair treatment, and willingness to do more than what is expected?');
            $table->string('a6');
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
        Schema::dropIfExists('customer_satisfaction_survey');
    }
};
