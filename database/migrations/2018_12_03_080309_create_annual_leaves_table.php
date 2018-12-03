<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnualLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annual_leaves', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('employee_id');
            $table->date('request_dt')->nullable();
            $table->date('start_dt')->nullable();
            $table->date('return_dt')->nullable();

            $table->date('emp_dt')->nullable();
            $table->date('foreman_dt')->nullable();
            $table->date('management_dt')->nullable();

            $table->timestamps();
        });

        DB::statement("ALTER TABLE annual_leaves ADD emp_signature LONGBLOB NULL DEFAULT NULL");
        DB::statement("ALTER TABLE annual_leaves ADD foreman_signature LONGBLOB NULL DEFAULT NULL");
        DB::statement("ALTER TABLE annual_leaves ADD management_signature LONGBLOB NULL DEFAULT NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('annual_leaves');
    }
}
