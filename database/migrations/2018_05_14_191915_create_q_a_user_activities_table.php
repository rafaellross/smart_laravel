<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQAUserActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q_a_user_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('qa_type');
            $table->integer('order');            
            $table->string('description');
            $table->string('at', 1);
            $table->string('requirements');
            $table->string('reference');
            $table->string('installed_by');
            $table->string('checked_by');
            $table->date('activity_date');
            $table->timestamps();            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('q_a_user_activities');
    }
}
