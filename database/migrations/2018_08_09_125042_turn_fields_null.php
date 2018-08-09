<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TurnFieldsNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_applications', function (Blueprint $table) {
          $table->string('first_name')->nullable()->change();
          $table->string('last_name')->nullable()->change();
          $table->date('dob')->nullable()->change();
          $table->string('street_address')->nullable()->change();
          $table->string('suburb')->nullable()->change();
          $table->string('post_code')->nullable()->change();
          $table->string('state')->nullable()->change();
          $table->string('mobile')->nullable()->change();
          $table->string('phone')->nullable()->change();
          $table->string('email')->nullable()->change();
          $table->string('emergency_name')->nullable()->change();
          $table->string('emergency_phone')->nullable()->change();
          $table->string('emergency_relationship')->nullable()->change();
          $table->string('tax_file_number')->nullable()->change();
          $table->string('date_commenced')->nullable()->change();
          $table->string('bank_acc_name')->nullable()->change();
          $table->string('bsb')->nullable()->change();
          $table->string('account_number')->nullable()->change();
          $table->string('superannuation')->nullable()->change();
          $table->string('redundancy')->nullable()->change();
          $table->string('long_service_number')->nullable()->change();
          $table->boolean('apprentice')->nullable()->change();
          $table->integer('apprentice_year')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_applications', function (Blueprint $table) {
            //
        });
    }
}
