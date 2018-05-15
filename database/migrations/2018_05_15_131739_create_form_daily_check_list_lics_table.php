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
            $table->string('op_name');
            $table->string('op_initials');
            $table->string('op_driver_lic');
            $table->string('op_ticket');
            $table->string('op_induction_car');
            $table->string('op_track_safety');            
            $table->timestamps();
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
