<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmvLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmv_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('job_id');
            $table->date('log_dt');

            $table->string('type')->nullable();
            $table->string('name_establishment')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();

            $table->string('room_number')->nullable();
            $table->string('location_number')->nullable();
            $table->string('location')->nullable();

            $table->string('type_valve')->nullable();

            $table->string('size')->nullable();

            $table->string('serial_number')->nullable();

            $table->string('temp_range')->nullable();


            $table->boolean('task_tk_1')->default(false);
            $table->boolean('task_tk_2')->default(false);
            $table->boolean('task_tk_3')->default(false);
            $table->boolean('task_tk_4')->default(false);
            $table->boolean('task_tk_5')->default(false);
            $table->boolean('task_tk_6')->default(false);
            $table->boolean('task_tk_7')->default(false);

            $table->string('task_rmk_1')->nullable();
            $table->string('task_rmk_2')->nullable();
            $table->string('task_rmk_3')->nullable();
            $table->string('task_rmk_4')->nullable();
            $table->string('task_rmk_5')->nullable();
            $table->string('task_rmk_6')->nullable();
            $table->string('task_rmk_7')->nullable();

            //Endorsed 1
            $table->string('endorsed_by1')->nullable();
            $table->string('endorsed_position1')->nullable();

            //Thermal shut off test
            $table->string('temp_bfr_test')->nullable();
            $table->string('temp_reset')->nullable();
            $table->boolean('therm_shutoff')->nullable();

            //Serviceman 2
            $table->string('serviceman2')->nullable();
            $table->string('serviceman2_lic')->nullable();


            //Endorsed 2
            $table->string('endorsed_by2')->nullable();
            $table->string('endorsed_position2')->nullable();


            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');


            $table->timestamps();
        });

        DB::statement("ALTER TABLE tmv_logs ADD serviceman2_sig LONGBLOB NULL DEFAULT NULL");

        DB::statement("ALTER TABLE tmv_logs ADD endorsed1_sig LONGBLOB NULL DEFAULT NULL");
        DB::statement("ALTER TABLE tmv_logs ADD endorsed2_sig LONGBLOB NULL DEFAULT NULL");

        DB::statement("ALTER TABLE tmv_logs ADD photo LONGBLOB NULL DEFAULT NULL");


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tmv_logs');
    }
}
