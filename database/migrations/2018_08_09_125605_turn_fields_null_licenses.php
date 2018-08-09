<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TurnFieldsNullLicenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_licenses', function (Blueprint $table) {

          $table->date('issue_date')->nullable()->change();
          $table->string('issuer')->nullable()->change();
          $table->string('number')->nullable()->change();
          $table->unsignedInteger('application_id')->change();
          $table->unsignedInteger('license_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_licenses', function (Blueprint $table) {
            //
        });
    }
}
