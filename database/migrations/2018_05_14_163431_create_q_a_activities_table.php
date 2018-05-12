<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQAActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q_a_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('qa_type');
            $table->integer('order')->nullable();
            $table->string('description')->nullable();
            $table->string('at', 1)->nullable();
            $table->string('requirements')->nullable();
            $table->timestamps();
            $table->foreign('qa_type')->references('id')->on('q_a_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('q_a_activities');
    }
}
