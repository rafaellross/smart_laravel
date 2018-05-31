<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNightWorkToDay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('days', function (Blueprint $table) {

        $table->string('total_night')->nullable();

        $table->string('normal_night')->nullable();

        $table->string('total_15_night')->nullable();

        $table->string('total_20_night')->nullable();

      });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
