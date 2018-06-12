<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEmployeeApplication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('employee_applications', function (Blueprint $table) {
        $table->unsignedInteger('business')->nullable();
        $table->date('business_dt')->nullable();
        $table->boolean('still_paying')->default(true);
        //$table->foreign('business')->references('id')->on('parameters')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
