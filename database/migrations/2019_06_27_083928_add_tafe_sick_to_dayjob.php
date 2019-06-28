<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTafeSickToDayjob extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('day_jobs', function (Blueprint $table) {
            $table->boolean('tafe')->default(false);
            $table->boolean('sick')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('day_jobs', function (Blueprint $table) {
            //
        });
    }
}
