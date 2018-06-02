<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGenderPaidBaseTaxoptionEmployeeApp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_applications', function (Blueprint $table) {
            $table->string('gender')->nullable();
            $table->string('paid_basis')->nullable();
            $table->date('form_dt')->nullable();                                                
        });
        DB::statement("ALTER TABLE employee_applications ADD employee_signature LONGBLOB NULL DEFAULT NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_applicatons', function (Blueprint $table) {
            //
        });
    }
}
