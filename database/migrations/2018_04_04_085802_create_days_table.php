<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('days', function (Blueprint $table) {
            $table->increments('id');
            $table->date('day_dt');
            $table->integer('week_day');
            $table->string('total')->nullable();
            $table->string('normal')->nullable();
            $table->string('total_15')->nullable(); 
            $table->string('total_20')->nullable();
            $table->unsignedInteger('time_sheet_id');            
            $table->timestamps();
            $table->foreign('time_sheet_id')->references('id')->on('time_sheets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('days');
    }
}
