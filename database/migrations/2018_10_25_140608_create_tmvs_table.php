<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmvs', function (Blueprint $table) {
            $table->increments('id');


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
            $table->integer('job_id')->unsigned();
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
        Schema::dropIfExists('tmvs');
    }
}
