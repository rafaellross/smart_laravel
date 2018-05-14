<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQAUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q_a_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->string('location');
            $table->integer('qa_type');
            $table->string('revision');
            $table->date('update_date');
            $table->string('project')->nullable();
            $table->string('customer')->nullable();
            $table->string('unit_area')->nullable();
            $table->string('site_manager')->nullable();
            $table->unsignedInteger('foreman')->nullable();
            $table->string('distribution')->nullable();
            $table->text('comments')->nullable();
            $table->string('approved_name_1')->nullable();
            $table->string('approved_name_2')->nullable();
            $table->string('approved_name_3')->nullable();
            $table->string('approved_name_4')->nullable();

            $table->string('approved_company_1')->nullable();
            $table->string('approved_company_2')->nullable();
            $table->string('approved_company_3')->nullable();
            $table->string('approved_company_4')->nullable();

            $table->string('approved_position_1')->nullable();
            $table->string('approved_position_2')->nullable();
            $table->string('approved_position_3')->nullable();
            $table->string('approved_position_4')->nullable();

            $table->binary('approved_sign_1')->nullable();
            $table->binary('approved_sign_2')->nullable();
            $table->binary('approved_sign_3')->nullable();
            $table->binary('approved_sign_4')->nullable();
            $table->timestamps();
            $table->foreign('foreman')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('q_a_users');
    }
}
