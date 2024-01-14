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
            $table->text('file_status')->default('Available')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('requestingform', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date')->nullable();
            $table->string('email_address')->nullable();
            $table->text('thesis_type')->nullable();
            $table->text('advisors_turnitin_precheck');
            $table->integer('adviser_id')->unsigned()->nullable();
            $table->foreign('adviser_id')->references('id')->on('faculty');
            $table->text('submission_frequency')->default('First Submission')->nullable();
            $table->text('research_specialist')->nullable();
            $table->string('tup_id')->nullable();
            $table->text('requestor_name')->nullable();
            $table->string('tup_mail')->nullable();
            $table->text('sex')->nullable();
            $table->text('requestor_type')->nullable();
            $table->text('college')->nullable();
            $table->text('course')->nullable();
            $table->text('purpose')->nullable();
            $table->text('researchers_name1')->nullable();
            $table->text('researchers_name2')->nullable();
            $table->text('researchers_name3')->nullable();
            $table->text('researchers_name4')->nullable();
            $table->text('researchers_name5')->nullable();
            $table->text('researchers_name6')->nullable();
            $table->text('researchers_name7')->nullable();
            $table->text('researchers_name8')->nullable();
            $table->string('adviser_email')->nullable();
            $table->text('status')->default('Pending')->nullable();
            $table->string('initial_simmilarity_percentage')->nullable()->default('0');
            $table->text('simmilarity_percentage_results')->default('0')->nullable();
            $table->text('agreement')->nullable();
            $table->text('score')->nullable()->default('0');
            $table->text('research_staff')->nullable();
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
