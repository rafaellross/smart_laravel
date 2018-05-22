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
            $table->string('gender');
            $table->string('paid_basis');
            $table->date('form_dt');
            $table->boolean('claim_threshold');
            $table->string('tax_status');
            $table->boolean('educational_loan');
            $table->boolean('financial_supplement');

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
