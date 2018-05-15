<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormDailyCheckListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_daily_check_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user');
            $table->date('dt_form');
            $table->string('working_for')->nullable();
            $table->string('plant_description')->nullable();
            $table->string('make_model')->nullable();
            $table->string('serial_no')->nullable();
            $table->string('job_site')->nullable();
            $table->string('reg_permit')->nullable();
            $table->date('expire_dt')->nullable();
            $table->string('km_reading')->nullable();
            $table->string('reported_to')->nullable();
            $table->string('reported_to_position')->nullable();
            $table->date('reported_to_date')->nullable();
            $table->string('require_repair')->nullable();
            $table->string('safety_hazard')->nullable();            
            $table->timestamps();
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_daily_check_lists');
    }
}
