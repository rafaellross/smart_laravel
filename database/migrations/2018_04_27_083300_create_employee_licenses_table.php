<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_licenses', function (Blueprint $table) {
            $table->increments('id');
            $table->date('issue_date');
            $table->string('issuer');
            $table->string('number');
            $table->unsignedInteger('application_id');
            $table->unsignedInteger('license_id');
            $table->foreign('application_id')->references('id')->on('employee_applications')->onDelete('cascade');
            $table->foreign('license_id')->references('id')->on('licenses')->onDelete('cascade');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE employee_licenses ADD image_front LONGBLOB");
        DB::statement("ALTER TABLE employee_licenses ADD image_back LONGBLOB");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_licenses');
    }
}
