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
            $table->unsignedInteger('qa_type')->nullable();
            $table->integer('order')->nullable();
            $table->string('description')->nullable();
            $table->string('at', 1)->nullable();
            $table->string('requirements')->nullable();
            $table->string('reference')->nullable();
            $table->string('installed_by')->nullable();
            $table->string('yes_no');            
            $table->string('checked_by')->nullable();
            $table->date('activity_date')->nullable();
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
