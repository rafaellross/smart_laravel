<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDayJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('day_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('job_id')->nullable();
            $table->unsignedInteger('day_id')->nullable();
            $table->integer('start')->nullable();
            $table->integer('end')->nullable();
            $table->timestamps();
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->foreign('day_id')->references('id')->on('days');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('day_jobs');
    }
}
