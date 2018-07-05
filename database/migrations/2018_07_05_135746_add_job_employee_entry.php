<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJobEmployeeEntry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_entries', function (Blueprint $table) {
          $table->unsignedInteger('job_id')->nullable();
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
        Schema::table('employee_entries', function (Blueprint $table) {
            //
        });
    }
}
