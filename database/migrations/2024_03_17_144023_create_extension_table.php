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
        Schema::create('prototype', function (Blueprint $table) {
            $table->increments('id');
            $table->string('letter')->nullable();
            $table->string('nda')->nullable();
            $table->string('coa')->nullable();
            $table->string('pre_evaluation_survey')->nullable();
            $table->string('mid_evaluation_survey')->nullable();
            $table->string('post_evaluation_survey')->nullable();
            $table->string('capsule_detail')->nullable();
            $table->string('certificate')->nullable();
            $table->string('attendance')->nullable();
            $table->timestamps();
        });

        Schema::create('prototype_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prototype_id')->unsigned()->nullable();
            $table->foreign('prototype_id')->references('id')->on('prototype');
            $table->string('img_path');
            $table->timestamps();
        });

        Schema::create('extension', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->integer('appointment1_id')->unsigned()->nullable();
            $table->foreign('appointment1_id')->references('id')->on('appointments');
            $table->string('mou_file')->nullable();
            $table->string('beneficiary')->nullable();
            $table->string('ppmp_file')->nullable();
            $table->string('pr_file')->nullable();
            $table->string('market_study_file')->nullable();
            $table->string('do_email')->nullable();
            $table->string('ues_email')->nullable();
            $table->string('president_email')->nullable();
            $table->string('moa_file')->nullable();
            $table->string('board_email')->nullable();
            $table->string('osg_email')->nullable();
            $table->string('proponents1')->nullable();
            $table->string('proponents2')->nullable();
            $table->string('proponents3')->nullable();
            $table->string('proponents4')->nullable();
            $table->string('proponents5')->nullable();
            $table->string('implementation_proper')->nullable();
            $table->string('topics')->nullable();
            $table->string('subtopics')->nullable();
            $table->integer('appointment2_id')->unsigned()->nullable();
            $table->foreign('appointment2_id')->references('id')->on('appointments');
            $table->integer('appointment3_id')->unsigned()->nullable();
            $table->foreign('appointment3_id')->references('id')->on('appointments');
            $table->string('post_evaluation_attendance')->nullable();
            $table->string('evaluation_form')->nullable();
            $table->string('capsule_detail')->nullable();
            $table->string('certificate')->nullable();
            $table->string('attendance')->nullable();
            $table->string('status')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('prototype_id')->unsigned()->nullable();
            $table->foreign('prototype_id')->references('id')->on('prototype');
            $table->string('percentage_status')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('documentation_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('extension_id')->unsigned()->nullable();
            $table->foreign('extension_id')->references('id')->on('extension');
            $table->string('img_path');
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
        Schema::dropIfExists('extension');
    }
};
