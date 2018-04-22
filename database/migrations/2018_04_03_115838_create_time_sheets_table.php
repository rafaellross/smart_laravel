<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_sheets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status')->default('P');
            $table->binary('emp_signature')->nullable();
            $table->unsignedInteger('employee_id');
            $table->date('week_end');
            $table->integer('rdo')->nullable();
            $table->integer('pld')->nullable();
            $table->integer('anl')->nullable();
            $table->string('total')->nullable();
            $table->string('normal')->nullable();
            $table->string('total_15')->nullable();
            $table->string('total_20')->nullable();
            $table->unsignedInteger('user_id');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_sheets');
    }
}
