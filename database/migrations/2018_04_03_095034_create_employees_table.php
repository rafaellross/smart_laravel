<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('rdo')->default(false);
            $table->boolean('travel')->default(false);
            $table->boolean('site_allow')->default(false);
            $table->timestamp('last_time_sheet_dt')->nullable();
            $table->integer('last_time_sheet_id')->nullable();
            $table->float('bonus')->default(0);
            $table->float('pld')->default(0);
            $table->float('rdo_bal')->default(0);
            $table->float('anl')->default(0);
            $table->string('phone');
            $table->boolean('foreman')->default(false);
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
        Schema::dropIfExists('employees');
    }
}
