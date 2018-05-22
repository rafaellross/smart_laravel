<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_applications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob');
            $table->string('street_address');
            $table->string('suburb');
            $table->string('post_code');
            $table->string('state');
            $table->string('mobile');
            $table->string('phone');
            $table->string('email');
            $table->string('emergency_name');
            $table->string('emergency_phone');
            $table->string('emergency_relationship');
            $table->string('tax_file_number');
            $table->string('date_commenced');
            $table->string('bank_acc_name');
            $table->string('bsb');
            $table->string('account_number');
            $table->string('superannuation');
            $table->string('redundancy');
            $table->string('long_service_number');
            $table->boolean('apprentice');
            $table->integer('apprentice_year');
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
        Schema::dropIfExists('employee_applications');
    }
}
