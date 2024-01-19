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
        Schema::create('certificates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('control_id')->unique();
            $table->string('certificate_file')->nullable();
            $table->timestamps();
        });

        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->text('research_title');
            $table->string('research_file');
            $table->text('file_status')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('requestingform', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date')->nullable();
            $table->string('email_address')->nullable();
            $table->string('thesis_type')->nullable();
            $table->string('advisors_turnitin_precheck')->nullable();
            $table->integer('adviser_id')->unsigned()->nullable();
            $table->foreign('adviser_id')->references('id')->on('faculty');
            $table->string('submission_frequency')->nullable();
            $table->string('research_specialist')->nullable();
            $table->string('tup_id')->nullable();
            $table->string('requestor_name')->nullable();
            $table->string('tup_mail')->nullable();
            $table->string('sex')->nullable();
            $table->string('requestor_type')->nullable();
            $table->string('college')->nullable();
            $table->string('course')->nullable();
            $table->string('purpose')->nullable();
            $table->string('researchers_name1')->nullable();
            $table->string('researchers_name2')->nullable();
            $table->string('researchers_name3')->nullable();
            $table->string('researchers_name4')->nullable();
            $table->string('researchers_name5')->nullable();
            $table->string('researchers_name6')->nullable();
            $table->string('researchers_name7')->nullable();
            $table->string('researchers_name8')->nullable();
            $table->string('adviser_email')->nullable();
            $table->string('status')->nullable();
            $table->string('initial_simmilarity_percentage')->nullable()->default('0');
            $table->string('simmilarity_percentage_results')->nullable()->default('0');
            $table->string('agreement')->nullable();
            $table->string('score')->nullable()->default('0');
            $table->string('research_staff')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('research_id')->unsigned()->nullable();
            $table->foreign('research_id')->references('id')->on('files')->onDelete('cascade');
            $table->integer('certificate_id')->unsigned()->nullable();
            $table->foreign('certificate_id')->references('id')->on('certificates')->onDelete('cascade');
            $table->string('date_processing_end')->nullable();
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
        Schema::dropIfExists('requestingform');
    }
};
