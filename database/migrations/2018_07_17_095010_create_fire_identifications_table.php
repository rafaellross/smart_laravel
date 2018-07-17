<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFireIdentificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fire_identifications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('job_id');
            $table->integer('fire_number');
            $table->string('fire_seal_ref');
            $table->string('fire_resist_level');

            $table->date('install_dt');
            $table->string('install_by');
            $table->string('manufacturer');            
            $table->timestamps();

            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fire_identifications');
    }
}
