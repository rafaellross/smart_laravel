<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormDailyCheckListLicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_daily_check_list_lics', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('checklist');         
            $table->integer('number');
            $table->string('op_name')->nullable();
            $table->string('op_initials')->nullable();
            $table->string('op_driver_lic')->nullable();
            $table->string('op_ticket')->nullable();
            $table->string('op_induction_car')->nullable();
            $table->string('op_track_safety')->nullable();
            $table->timestamps();
            $table->foreign('checklist')->references('id')->on('form_daily_check_lists')->onDelete('cascade');
        });
        DB::statement("ALTER TABLE form_daily_check_list_lics ADD signature LONGBLOB NULL DEFAULT NULL");        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_daily_check_list_lics');
    }
}
